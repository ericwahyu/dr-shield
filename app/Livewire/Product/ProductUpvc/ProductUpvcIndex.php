<?php

namespace App\Livewire\Product\ProductUpvc;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class ProductUpvcIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $product, $category, $name, $profile, $effective_width, $price;
    public $perPage = 10, $search;

    public function render()
    {
        $products = Product::search($this->search);

        return view('livewire.product.product-upvc.product-upvc-index', [
            'products' => $products->whereCalculated('upvc')->paginate($this->perPage),
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('product', 'category', 'name', 'profile', 'effective_width', 'price');
        $this->dispatch('closeModal');
    }

    public function saveData()
    {
        $this->validate([
            'category'            => 'required',
            'name'            => 'required',
            'profile'         => 'required',
            'effective_width' => 'required',
            'price'           => 'required',
        ]);

        try {
            //code...
            DB::transaction(function () {
                Product::updateOrCreate(
                    ['id' => $this->product?->id],
                    [
                        'category'        => $this->category,
                        'name'            => $this->name,
                        'profile'         => $this->profile,
                        'effective_width' => $this->effective_width,
                        'price'           => $this->price,
                        'is_roof'         => 0,
                    ]
                );
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

        $this->closeModal();

        return $this->alert('success', 'Berhasil', [
            'text' => 'Data UPVC Telah Disimpan !'
        ]);
    }

    public function edit($product_id)
    {
        $this->product = Product::find($product_id);

        $this->category        = $this->product?->category;
        $this->name            = $this->product?->name;
        $this->profile         = $this->product?->profile;
        $this->effective_width = $this->product?->effective_width;
        $this->price           = $this->product?->price;

        $this->dispatch('openModal');
    }

    public function deleteConfirm($id)
    {
        $this->confirm('Konfirmasi', [
            'inputAttributes'    => ['id' => $id],
            'onConfirmed'        => 'delete',
            'text'               => 'Data yang dihapus tidak dapat di kembalikan lagi',
            'reverseButtons'     => 'true',
            'confirmButtonColor' => '#24B464',
        ]);
    }

    public function getListeners()
    {
        return ['delete'];
    }

    public function delete($data)
    {
        try {
            //code...
            DB::transaction(function () use ($data) {
                $result = Product::find($data['inputAttributes']['id']);
                $result->delete();
            });

            DB::commit();
        } catch (Throwable | Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return $this->alert('error', 'Maaf', [
                'text' => 'Terjadi Kesalahan Saat Menghapus Data!'
            ]);
        }

        $this->closeModal();

        return $this->alert('success', 'Berhasil', [
            'text' => 'Data UPVC Telah Dihapus !'
        ]);
    }
}
