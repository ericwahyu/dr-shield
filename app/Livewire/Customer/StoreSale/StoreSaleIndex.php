<?php

namespace App\Livewire\Customer\StoreSale;

use App\Models\Customer;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use Illuminate\Support\Str;

class StoreSaleIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $get_order;
    public $id_data, $date, $category, $name, $phone, $needs, $address, $store, $description, $response, $total_price;
    public $start_date, $end_date, $grand_total;
    public $perPage = 10, $search;

    public function render()
    {
        $orders = Order::search($this->search);

        if ($this->start_date && $this->end_date) {
            $orders = $orders->whereDate('order_date', '>=', $this->start_date)->whereDate('order_date', '<=', $this->end_date);

            $this->grand_total = OrderDetail::whereHas('order', function($query){
                $query->whereHas('customer', function($query){
                    $query->where('category', 'store');
                })
                ->whereDate('order_date', '>=', $this->start_date)->whereDate('order_date', '<=', $this->end_date);
            })->sum('total_price');
        }

        return view('livewire.customer.store-sale.store-sale-index', [
            // 'customers' => $customers->whereResponse('done')->paginate($this->perPage),
            'orders' => $orders->whereHas('customer', function($query){
                $query->where('category', 'store');
            })->latest()->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('id_data', 'date', 'category', 'name', 'phone', 'needs', 'address', 'store', 'description', 'response', 'total_price', 'get_order');
        $this->dispatch('closeModal');
    }

    public function clearFilter()
    {
        $this->reset('start_date', 'end_date', 'grand_total');
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
        $this->response    = $get_customer?->response;
        $this->total_price = $get_customer?->total_price;

        $this->dispatch('openModal');
    }

    public function saveData()
    {
        $phone = intval($this->phone);
        $phone = "{$phone}";

        if ($phone[0] == '6' && $phone[1] == '2') $phone = substr($phone, 2);
        $this->phone = intval($phone);

        $this->validate([
            'date'        => 'required|date',
            'category'    => 'required',
            'name'        => 'required',
            'phone'       => 'required|numeric|digits_between:9,15',
            'needs'       => 'required',
            'address'     => 'required',
            'store'       => 'required',
            'description' => 'nullable',
            'response'    => 'required',
            'total_price' => 'nullable',
        ]);

        DB::transaction(function () {
            Customer::updateOrCreate(
                ['id' => $this->id_data],
                [
                    'date'        => $this->date,
                    'category'    => $this->category,
                    'name'        => Str::title($this->name),
                    'phone'       => '0'.$this->phone,
                    'needs'       => $this->needs,
                    'address'     => $this->address,
                    'store'       => $this->store,
                    'description' => $this->description,
                    'response'    => $this->response,
                    'total_price' => $this->total_price ? $this->total_price : 0,
                ]
            );
        });
        DB::commit();
        try {
            //code...
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
            'text' => 'Data Penjualan Toko Telah Disimpan !'
        ]);
    }

    public function detail($order_id)
    {
        $this->get_order = Order::find($order_id);

        return $this->dispatch('openModalDetail');
    }

    public function printOrder($get_order_id)
    {
        // $this->dispatch('closeModal');

        Order::find($get_order_id)?->update([
            'print_at' => Carbon::now()
        ]);

        $this->get_order = Order::find($get_order_id);

        return $this->dispatch('openModalDetail');

        // return $this->alert('success', 'Berhasil', [
        //     'text' => 'Data Pelanggan Telah Disimpan !'
        // ]);
    }
}
