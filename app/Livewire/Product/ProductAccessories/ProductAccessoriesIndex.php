<?php

namespace App\Livewire\Product\ProductAccessories;

use Livewire\Component;

class ProductAccessoriesIndex extends Component
{
    public function render()
    {
        return view('livewire.product.product-accessories.product-accessories-index')->extends('layouts.layout.app')->section('content');
    }
}
