<?php

namespace App\Livewire\MasterData\AdminData;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use Illuminate\Support\Str;

class AdminDataIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $perPage = 10, $search;
    public $admin, $name, $email, $status;

    public function render()
    {
        return view('livewire.master-data.admin-data.admin-data-index', [
            'admins' => User::role('admin')->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('admin', 'name', 'email', 'status');
        $this->dispatch('closeModal');
    }

    public function edit($user_id)
    {
        $this->admin = User::find($user_id);

        $this->name   = $this->admin?->name;
        $this->email  = $this->admin?->email;
        $this->status = $this->admin?->status;

        $this->dispatch('openModal');
    }

    public function saveData()
    {
        $this->validate([
            'name'   => 'required',
            'email'  => 'required|email',
            'status' => 'required',
        ]);

        try {
            //code...
            DB::transaction(function () {
                $this->admin?->update([
                    'name'   => Str::title($this->name),
                    'email'  => Str::lower($this->email),
                    'status' => $this->status
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

        $this->closeModal();

        return $this->alert('success', 'Berhasil', [
            'text' => 'Data Akun Admin disimpan !'
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
                $result = User::find($data['inputAttributes']['id']);
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
            'text' => 'Data Admin Telah Dihapus !'
        ]);
    }
}
