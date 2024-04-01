<?php

namespace App\Livewire\Auth\AuthLogin;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;

class AuthLoginIndex extends Component
{
    use LivewireAlert;
    public $email, $password;

    public function render()
    {
        return view('livewire.auth.auth-login.auth-login-index')->extends('layouts.auth.layout')->section('content');
    }

    public function mount($token = null)
    {
        if ($token) {

            $password_reset_tokens = DB::table('password_reset_tokens')->where('token', $token)->first();
            if (!$password_reset_tokens) abort(404);
            // $this->reset_password['email'] = $password_reset_tokens->email;
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function login()
    {
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $this->email = Str::lower($this->email);


        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {

            if (Auth::user()->status == 'active') {
                // dd(Auth::check());
                return redirect()->route('dashboard');
            } else {
                // Session::flush();
                Auth::logout();
                $this->reset('email, password');
                return $this->alert('error', 'Maaf !', [
                    'text' => "Akun Anda telah di non aktifkan !",
                ]);
            }
        } else {
            // Session::flush();
            Auth::logout();

            $this->reset('email, password');

            return $this->alert('error', 'Gagal!', [
                'text' => "Alamat Email atau Kata Sandi Anda salah!",
            ]);
        }
    }
}
