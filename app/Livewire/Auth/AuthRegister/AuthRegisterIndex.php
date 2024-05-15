<?php

namespace App\Livewire\Auth\AuthRegister;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;

class AuthRegisterIndex extends Component
{
    use LivewireAlert;
    public $name, $email, $password;

    public function render()
    {
        return view('livewire.auth.auth-register.auth-register-index')->extends('layouts.auth.layout')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function register()
    {
        $this->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        try {
            //code...
            DB::transaction(function () {
                $new_user = User::create([
                    'name'     => $this->name,
                    'email'    => Str::lower($this->email),
                    'password' => Hash::make($this->password),
                    'status'   => 'active',
                ]);

                $new_user->assignRole('admin');
            });
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            Log::error($th->getMessage());

            return $this->alert('error', 'Maaf', [
                'text' => 'Terjadi Kesalahan Saat Membuat Akun !'
            ]);
        }

        $this->reset('name', 'email', 'password');

        return $this->alert('success', 'Berhasil', [
            'text' => 'Data Akun Telah Disimpan !'
        ]);
    }
}
