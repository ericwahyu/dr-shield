<?php

namespace App\Livewire\Customer\CustomerOrder;

use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use Illuminate\Support\Str;

class CustomerOrderIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $id_data, $name, $phone, $needs, $address, $store, $description, $response, $total_price;
    public $start_date, $end_date, $grand_total;
    public $perPage = 10, $search;

    public function render()
    {
        $customers = Customer::search($this->search);

        if ($this->start_date && $this->end_date) {
            $customers = $customers->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);

            $this->grand_total = Customer::whereResponse('done')->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date)->sum('total_price');
        }

        return view('livewire.customer.customer-order.customer-order-index', [
            'customers' => $customers->whereResponse('done')->latest()->paginate($this->perPage),
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('id_data', 'name', 'phone', 'needs', 'address', 'store', 'description', 'response', 'total_price');
        $this->dispatch('closeModal');
    }

    public function edit($id)
    {
        $get_customer = Customer::find($id);

        $this->id_data     = $get_customer->id;
        $this->name        = $get_customer->name;
        $this->phone       = '0' . $get_customer->phone;
        $this->needs       = $get_customer->needs;
        $this->address     = $get_customer->address;
        $this->store       = $get_customer->store;
        $this->description = $get_customer->description;
        $this->response    = $get_customer->response;
        $this->total_price = $get_customer->total_price;

        $this->dispatch('openModal');
    }

    public function saveData()
    {
        $phone = intval($this->phone);
        $phone = "{$phone}";

        if ($phone[0] == '6' && $phone[1] == '2') $phone = substr($phone, 2);
        $this->phone = intval($phone);

        $this->validate([
            'name'        => 'required',
            'phone'       => 'required|numeric|digits_between:9,15',
            'needs'       => 'nullable',
            'address'     => 'nullable',
            'store'       => 'nullable',
            'description' => 'nullable',
            'response'    => 'required',
            'total_price' => 'nullable',
        ]);

        DB::transaction(function () {
            Customer::updateOrCreate(
                ['id' => $this->id_data],
                [
                    'name'        => Str::title($this->name),
                    'phone'       => $this->phone,
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
            'text' => 'Data Pelanggan Masuk Telah Disimpan !'
        ]);
    }

    public function clearFilter()
    {
        $this->reset('start_date', 'end_date', 'grand_total');
    }

    public function deleteConfirm($id)
    {
        $this->confirm('Konfirmasi', [
            'inputAttributes' => ['id' => $id],
            'onConfirmed'     => 'delete',
            'text'            => 'Data yang dihapus tidak dapat di kembalikan lagi',
            'reverseButtons' => 'true',
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
                $result = Customer::find($data['inputAttributes']['id']);
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
            'text' => 'Data pelanggan Masuk Telah Dihapus !'
        ]);
    }
}
