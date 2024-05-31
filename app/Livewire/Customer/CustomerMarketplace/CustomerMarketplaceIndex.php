<?php

namespace App\Livewire\Customer\CustomerMarketplace;

use App\Models\Customer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Throwable;

class CustomerMarketplaceIndex extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_data, $date, $category, $name, $phone, $needs, $address, $store, $description, $marketplace, $response, $filter_date;
    public $perPage = 10, $search;

    public function render()
    {
        $customers = Customer::whereCategory('e-commerce')->search($this->search);
        return view('livewire.customer.customer-marketplace.customer-marketplace-index',[
            'customers' => $customers->orderBy('date', 'desc')->latest()->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->category = 'e-commerce';
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('id_data', 'name', 'phone', 'needs', 'address', 'store', 'description', 'marketplace', 'response');
        $this->dispatch('closeModal');
    }

    public function saveData()
    {
        $this->phone = Str::replace(['-', ' '], '', $this->phone);

        $phone = intval($this->phone);
        $phone = "{$phone}";

        if ($phone[0] == '6' && $phone[1] == '2') $phone = substr($phone, 2);
        $this->phone = intval($phone);
        // dd($this->phone);

        // dd($this->id_data, $this->name, $this->phone, $this->needs, $this->address, $this->store, $this->response);
        $this->validate([
            'date'        => 'required|date',
            'category'    => 'required',
            'name'        => 'nullable',
            'phone'       => 'required|numeric|digits_between:4,15',
            'needs'       => 'nullable',
            'address'     => 'nullable',
            'store'       => 'nullable',
            'description' => 'nullable',
            'marketplace' => 'nullable',
            'response'    => 'required',
        ]);

        try {
            //code...
            DB::transaction(function () {
                Customer::updateOrCreate(
                    ['id' => $this->id_data],
                    [
                        'date'        => $this->date,
                        'category'    => $this->category,
                        'name'        => $this->name,
                        'phone'       => '0'.$this->phone,
                        'needs'       => $this->needs,
                        'address'     => $this->address,
                        'store'       => $this->store,
                        'description' => $this->description,
                        'marketplace' => $this->marketplace,
                        'response'    => $this->response,
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
            'text' => 'Data Pelanggan E-Commerce Telah Disimpan !'
        ]);
    }

    public function edit($id_data)
    {
        $get_customer = Customer::find($id_data);

        $this->id_data     = $get_customer?->id;
        $this->date        = $get_customer?->date->format('Y-m-d');
        $this->category    = $get_customer?->category;
        $this->name        = $get_customer?->name;
        $this->phone       = $get_customer?->phone;
        $this->needs       = $get_customer?->needs;
        $this->address     = $get_customer?->address;
        $this->store       = $get_customer?->store;
        $this->description = $get_customer?->description;
        $this->marketplace = $get_customer?->marketplace;
        $this->response    = $get_customer?->response;

        $this->dispatch('openModal');
    }

}
