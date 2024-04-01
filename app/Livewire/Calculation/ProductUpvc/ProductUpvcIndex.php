<?php

namespace App\Livewire\Calculation\ProductUpvc;

use App\Models\Product;
use Livewire\Component;

class ProductUpvcIndex extends Component
{
    public $length, $width, $product;

    //value
    public $get_product;
    public $length_mm, $width_mm, $effective_width_product, $rate, $rate_roundup;
    public $length_value_1, $width_value_1, $width_value_2;
    public $length_roundup, $width_roundup;
    public $width_roundupx2;
    public $count_item;
    public $grand_total;

    public function render()
    {
        return view('livewire.calculation.product-upvc.product-upvc-index', [
            'products' => Product::whereIsRoof(0)->get()
        ])->extends('layouts.layout.app')->section('content');
    }

    public function productCalculator()
    {
        $this->validate([
            'length'  => 'required',
            'width'   => 'required',
            'product' => 'required',
        ]);

        // dd($this->length, $this->width, $this->product);
        $this->get_product = Product::find($this->product);

        if ($this->length > 12) {
            //1
            $this->rate = $this->length / 12;
            if(number_format($this->length / 12, 2) > number_format($this->length / 12, 0)){
                $this->rate_roundup = number_format($this->length / 12, 0) + 1;
            }else{
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
}
