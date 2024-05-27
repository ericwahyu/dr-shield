<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class ChangePassword extends Component
{
    use LivewireAlert;
    public $email;
    public $datas = [];

    public function render()
    {
        return view('livewire.change-password');
    }

    public function mount()
    {
        $this->email = Auth::user()->email;
    }

    public function closeModalChangePassword()
    {
        $this->reset('datas');
        $this->dispatch('closeModalChangePassword');
    }

    public function saveChangePassword()
    {
        $this->validate([
            'datas.old_password' => 'required',
            'datas.new_password' => 'required',
            'datas.password_confirmation' => 'required',
        ]);

        if (!Hash::check($this->datas['old_password'], Auth::user()?->password)) {
            $this->closeModalChangePassword();
            return $this->alert('error', 'Maaf !', [
                'text' => "Data yang anda masukkan tidak valid !",
            ]);
        } elseif ($this->datas['new_password'] != $this->datas['password_confirmation']) {
            $this->closeModalChangePassword();
            return $this->alert('error', 'Maaf !', [
                'text' => "Password konfirmasi tidak sesuai !",
            ]);
        }

        $get_user = User::find(Auth::user()?->id);

        try {
            //code...
            DB::transaction(function () use ($get_user) {
                $get_user?->update([
                    'password' => Hash::make($this->datas['new_password'])
                ]);
            });
            DB::commit();
        } catch (Exception | Throwable $th) {
            //throw $th;
            DB::rollBack();

            Log::error($th->getMessage());

            return $this->alert('error', 'Maaf', [
                'text' => 'Terjadi Kesalahan Saat Ubah Password!'
            ]);
        }

        $this->closeModalChangePassword();

        $this->alert('success', 'Berhasil !', [
            'text' => "Password berhasil di ubah !",
        ]);

        return redirect()->to('/logout');
    }
}
