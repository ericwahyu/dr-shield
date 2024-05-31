<?php

namespace App\Livewire\Customer\CustomerProject;

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

class CustomerProjectIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $id_data, $date, $category, $name, $phone, $needs, $address, $store, $description, $response, $total_price;
    public $start_date, $end_date, $grand_total;
    public $perPage = 10, $search;

    public function render()
    {
        $customers = Customer::whereCategory('project')->search($this->search);

        if ($this->start_date && $this->end_date) {
            $customers = $customers->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date)->whereResponse('done')->whereNotNull('total_price');

            $this->grand_total = Customer::whereCategory('project')->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date)->whereResponse('done')->whereNotNull('total_price')->sum('total_price');
        }

        $orders = Order::search($this->search);

        if ($this->start_date && $this->end_date) {
            $orders = $orders->whereDate('order_date', '>=', $this->start_date)->whereDate('order_date', '<=', $this->end_date);

            $this->grand_total = OrderDetail::whereHas('order', function($query){
                $query->whereHas('customer', function($query){
                    $query->where('category', 'project');
                })
                ->whereDate('order_date', '>=', $this->start_date)->whereDate('order_date', '<=', $this->end_date);
            })->sum('total_price');
        }

        return view('livewire.customer.customer-project.customer-project-index',[
            'customers' => $customers->latest()->paginate($this->perPage),
            'orders' => $orders->whereHas('customer', function($query){
                $query->where('category', 'project');
            })->latest()->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function mount()
    {
        $this->date     = Carbon::now()->format('Y-m-d');
        $this->category = 'project';
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('id_data', 'date', 'name', 'phone', 'needs', 'address', 'store', 'description', 'response', 'total_price');
        $this->dispatch('closeModal');
    }

    public function clearFilter()
    {
        $this->reset('start_date', 'end_date', 'grand_total');
    }

    public function saveData()
    {
        $phone = intval($this->phone);
        $phone = "{$phone}";

        if ($phone[0] == '6' && $phone[1] == '2') $phone = substr($phone, 2);
        $this->phone = intval($phone);

        // dd($this->id_data, $this->name, $this->phone, $this->needs, $this->address, $this->store, $this->response);
        $this->validate([
            'date'        => 'required|date',
            'category'    => 'required',
            'name'        => 'required',
            'phone'       => 'required|numeric|digits_between:4,15',
            'needs'       => 'nullable',
            'address'     => 'nullable',
            'store'       => 'nullable',
            'description' => 'nullable',
            'response'    => 'required',
            'total_price' => 'nullable',
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
                        'response'    => $this->response,
                        'total_price' => $this->total_price,
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
            'text' => 'Data Pelanggan Proyek Telah Disimpan !'
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
        $this->response    = $get_customer?->response;
        $this->total_price = $get_customer?->total_price;

        $this->dispatch('openModal');
    }
}
