<?php

namespace App\Livewire\Order\OrderHistory;

use App\Models\OrderHistory;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistoryIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $perPage = 10, $search;
    public $length, $width;

    //value rrof
    public $get_product;
    public $length_mm, $width_mm, $length_product, $width_product;
    public $length_value_1, $width_value_1;
    public $length_roundup, $width_roundup;
    public $count_item;
    public $grand_total;

    //value
    public $effective_width_product, $rate, $rate_roundup;
    public $width_value_2;
    public $width_roundupx2;

    public function render()
    {
        $order_histories = OrderHistory::search($this->search);

        return view('livewire.order.order-history.order-history-index', [
            'order_histories' => $order_histories->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function showInvoice($order_history_id)
    {
        $get_order_history = OrderHistory::find($order_history_id);
        $this->length = $get_order_history?->length;
        $this->width = $get_order_history?->width;

        if ($get_order_history?->product?->is_roof == 1) {

            $this->get_product = Product::find($get_order_history?->product?->id);

            //1
            $this->length_mm      = $this->length * 1000;
            $this->width_mm       = $this->width * 1000;
            $this->length_product = $this->get_product?->length;
            $this->width_product  = $this->get_product?->width;

            //2
            $this->length_value_1 = number_format($this->length_mm / $this->length_product, 2, ',', '.');
            $this->width_value_1  = number_format($this->width_mm / $this->width_product, 2, ',', '.');

            //3
            if (number_format($this->length_mm / $this->length_product, 2) > number_format($this->length_mm / $this->length_product, 0)) {
                $this->length_roundup = number_format($this->length_mm / $this->length_product, 0) + 1;
            } else {
                $this->length_roundup = number_format($this->length_mm / $this->length_product, 0);
            }

            if (number_format($this->width_mm / $this->width_product, 2) > number_format($this->width_mm / $this->width_product, 0)) {
                $this->width_roundup = number_format($this->width_mm / $this->width_product, 0) + 1;
            } else {
                $this->width_roundup = number_format($this->width_mm / $this->width_product, 0);
            }

            //4
            $this->count_item = $this->length_roundup * $this->width_roundup;

            //5
            $this->grand_total = $this->count_item * $this->get_product?->price;
        } elseif ($get_order_history?->product?->is_roof == 0) {

            $this->get_product = Product::find($get_order_history?->product?->id);

            if ($this->length > 12) {
                //1
                $this->rate = $this->length / 12;
                if (number_format($this->length / 12, 2) > number_format($this->length / 12, 0)) {
                    $this->rate_roundup = number_format($this->length / 12, 0) + 1;
                } else {
                    $this->rate_roundup = number_format($this->length / 12, 0);
                }

                $this->width_mm       = $this->width * 1000;
                $this->effective_width_product = $this->get_product?->effective_width;

                //2
                $this->length_value_1 = number_format($this->length / $this->rate_roundup, 2, ',', '.');
                $this->width_value_1 = number_format($this->width_mm / $this->effective_width_product, 2, ',', '.');

                //3
                if (number_format($this->length / $this->rate_roundup, 2) > number_format($this->length / $this->rate_roundup, 0)) {
                    $this->length_roundup = number_format($this->length / $this->rate_roundup, 0) + 1;
                } else {
                    $this->length_roundup = number_format($this->length / $this->rate_roundup, 0);
                }

                if (number_format($this->width_mm / $this->effective_width_product, 2) > number_format($this->width_mm / $this->effective_width_product, 0)) {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0) + 1;
                } else {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0);
                }

                //4
                $this->width_roundupx2 = $this->width_roundup * $this->rate_roundup;

                //5
                $this->count_item = $this->length_roundup * $this->width_roundupx2;

                //6
                $this->grand_total = $this->count_item * $this->get_product?->price;
            } else {
                //1
                $this->width_mm       = $this->width * 1000;
                $this->effective_width_product = $this->get_product?->effective_width;

                //2
                $this->width_value_2 = number_format($this->width_mm / $this->effective_width_product, 2, ',', '.');

                //3
                if (number_format($this->width_mm / $this->effective_width_product, 2) > number_format($this->width_mm / $this->effective_width_product, 0)) {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0) + 1;
                } else {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0);
                }

                //4
                $this->count_item = $this->length * $this->width_roundup;

                //5
                $this->grand_total = $this->count_item * $this->get_product?->price;
            }
        }

        $this->dispatch('openModal');
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }
}
