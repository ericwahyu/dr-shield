<?php

namespace App\Livewire\Calculation\ProductAccessories;

use App\Models\Product;
use Livewire\Component;

class ProductAccessoriesIndex extends Component
{
    public $length, $width, $pieces, $product;

    //value
    public $get_product;
    public $length_mm, $width_mm;
    public $width_product;
    public $width_roundup;
    public $count_item, $count_item_roundup;
    public $grand_total;

    public function render()
    {
        $this->get_product = Product::find($this->product);

        return view('livewire.calculation.product-accessories.product-accessories-index', [
            'products' => Product::whereIn('calculated', ['accessories', 'pieces'])->get()
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function productCalculator()
    {
        $this->validate([
            // 'length'  => $this->get_product?->calculated == 'accessories' ? 'required' : 'nullable',
            'width'   => $this->get_product?->calculated == 'accessories' ? 'required' : 'nullable',
            'pieces'  => $this->get_product?->calculated == 'pieces' ? 'required' : 'nullable',
            'product' => 'required',
        ]);
        // dd('ok');

        if($this->get_product?->calculated == 'accessories'){
            //1
            // $this->length_mm      = $this->length * 1000;
            $this->width_mm       = $this->width * 1000;
            $this->width_product  = $this->get_product?->effective_width;

            //2
            $this->count_item = $this->width_mm / $this->width_product;

            //2
            if(number_format($this->width_mm / $this->width_product, 2) > number_format($this->width_mm / $this->width_product, 0)){
                $this->count_item_roundup = number_format($this->width_mm / $this->width_product, 0) + 1;
            }else{
                $this->count_item_roundup = number_format($this->width_mm / $this->width_product, 0);
            }

            //3
            $this->grand_total = $this->count_item_roundup * $this->get_product?->price;

        } elseif ($this->get_product?->calculated == 'pieces'){
            //1
            $this->grand_total = $this->pieces * $this->get_product?->price;
        }
    }
}
