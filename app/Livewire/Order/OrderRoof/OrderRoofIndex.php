<?php

namespace App\Livewire\Order\OrderRoof;

use App\Models\OrderHistory;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class OrderRoofIndex extends Component
{
    use LivewireAlert;
    public $length, $width, $product;

    //value
    public $get_product;
    public $length_mm, $width_mm, $length_product, $width_product;
    public $length_value_1, $width_value_1;
    public $length_roundup, $width_roundup;
    public $count_item;
    public $grand_total;

    public function render()
    {
        return view('livewire.order.order-roof.order-roof-index', [
            'products' => Product::whereIsRoof(1)->get()
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function roofCalculator()
    {
        $this->validate([
            'length'  => 'required',
            'width'   => 'required',
            'product' => 'required',
        ]);

        // dd($this->length, $this->width, $this->product);
        $this->get_product = Product::find($this->product);

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
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function saveData()
    {
        try {
            //code...
            DB::transaction(function () {
                OrderHistory::create([
                    'product_id'  => $this->get_product?->id,
                    'length'      => $this->length,
                    'width'       => $this->width,
                    'total_item'  => $this->count_item,
                    'total_price' => $this->grand_total,
                ]);
            });
            DB::commit();
        } catch (Exception | Throwable $th) {
            //throw $th;
            DB::rollBack();

            Log::error($th->getMessage());

            return $this->alert('error', 'Maaf', [
                'text' => 'Terjadi Kesalahan Saat Menyimpan Data!'
            ]);
        }

        $this->reset('length', 'width', 'get_product');
        $this->dispatch('closeModal');

        return $this->alert('success', 'Berhasil', [
            'text' => 'Berhasil Menyimpan Data Pesanan !'
        ]);
    }
}
