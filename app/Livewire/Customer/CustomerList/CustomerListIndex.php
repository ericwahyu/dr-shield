<?php

namespace App\Livewire\Customer\CustomerList;

use App\Models\Customer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use Illuminate\Support\Str;

class CustomerListIndex extends Component
{
    use LivewireAlert, WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_data, $date, $category, $name, $phone, $needs, $address, $store, $description, $response, $filter_date;
    public $perPage = 10, $search;

    public function render()
    {
        $customers = Customer::search($this->search);

        return view('livewire.customer.customer-list.customer-list-index', [
            'customers' => $customers->orderBy('date', 'desc')->latest()->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('id_data', 'name', 'phone', 'needs', 'address', 'store', 'description', 'response');
        $this->dispatch('closeModal');
    }

    public function edit($id_data)
    {
        $get_customer = Customer::find($id_data);

        $this->id_data     = $get_customer?->id;
        $this->date        = $get_customer?->date->format('Y-m-d');
        $this->category    = $get_customer?->category;
        $this->name        = $get_customer?->name;
        $this->phone       = '0' . $get_customer?->phone;
        $this->needs       = $get_customer?->needs;
        $this->address     = $get_customer?->address;
        $this->store       = $get_customer?->store;
        $this->description = $get_customer?->description;
        $this->response    = $get_customer?->response;

        $this->dispatch('openModal');
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
            'text' => 'Data Pelanggan Telah Disimpan !'
        ]);
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
                $result = Customer::find($data['inputAttributes']['id']);
                $result?->delete();
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
            'text' => 'Data Pelanggan Telah Dihapus !'
        ]);
    }
}
