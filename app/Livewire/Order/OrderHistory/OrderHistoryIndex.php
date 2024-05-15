<?php

namespace App\Livewire\Order\OrderHistory;

use App\Models\Order\Order;
use App\Models\OrderHistory;
use App\Models\Product;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistoryIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $perPage = 10, $search;
    public $length, $width;

    // detail order
    public $get_order, $order_details = [];

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
        $orders = Order::search($this->search);
        return view('livewire.order.order-history.order-history-index', [
            'orders' => $orders->latest()->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function detail($order_id)
    {
        $this->get_order = Order::find($order_id);

        return $this->dispatch('openModal');
    }

    public function closeModal()
    {
        $this->reset('get_order');
        $this->dispatch('closeModal');
    }

    public function printOrder($get_order_id)
    {
        // $this->dispatch('closeModal');

        Order::find($get_order_id)?->update([
            'print_at' => Carbon::now()
        ]);

        $this->get_order = Order::find($get_order_id);

        return $this->dispatch('openModal');

        // return $this->alert('success', 'Berhasil', [
        //     'text' => 'Data Pelanggan Telah Disimpan !'
        // ]);
    }

}
