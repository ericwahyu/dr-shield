<?php

namespace App\Livewire\MarketingTool\Sample;

use App\Models\Sample;
use App\Models\SampleHistory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use Illuminate\Support\Str;

class SampleIndex extends Component
{
    use LivewireAlert,  WithPagination;
    public $perPage = 10, $search;
    public $name, $profile, $color, $stock;
    public $sample;

    public function render()
    {
        $samples = Sample::search($this->search);

        return view('livewire.marketing-tool.sample.sample-index', [
            'samples' => $samples->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->reset('sample', 'name', 'profile', 'color', 'stock');
        $this->dispatch('closeModal');
    }

    public function entryStock($sample_id)
    {
        $this->sample = Sample::find($sample_id);

        $this->dispatch('openModalEntry');
    }

    public function saveDataEntrySample()
    {
        $this->validate([
            'stock' => 'required'
        ]);

        try {
            //code...
            DB::transaction(function () {
                SampleHistory::create([
                    'sample_id' => $this->sample?->id,
                    'type'      => 'entry',
                    'value'     => $this->stock
                ]);

                $this->sample?->update([
                    'stock' => $this->sample?->stock + $this->stock
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
            'text' => 'Data Stock Sample Telah disimpan !'
        ]);
    }

    public function exitStock($sample_id)
    {
        $this->sample = Sample::find($sample_id);

        $this->dispatch('openModalExit');
    }

    public function saveDataExitSample()
    {
        $this->validate([
            'stock' => 'required'
        ]);

        try {
            //code...
            DB::transaction(function () {
                SampleHistory::create([
                    'sample_id' => $this->sample?->id,
                    'type'      => 'exit',
                    'value'     => $this->stock
                ]);

                $this->sample?->update([
                    'stock' => $this->sample?->stock - $this->stock
                ]);
            });
            Db::commit();
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
            'text' => 'Data Stock Sample Telah disimpan !'
        ]);
    }

    public function saveData()
    {
        $this->validate([
            'name'    => 'required',
            'profile' => 'required',
            'color'   => 'required',
            'stock'   => $this->sample ? 'nullable' : 'required',
        ]);

        try {
            //code...
            DB::transaction(function () {
                Sample::updateOrCreate(
                    ['id' => $this->sample?->id],
                    [
                        'name'    => $this->name,
                        'profile' => $this->profile,
                        'color'   => Str::lower($this->color),
                        'stock'   => $this->stock,
                    ]
                );
            });
            Db::commit();
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
            'text' => 'Data Sample Telah disimpan !'
        ]);
    }

    public function edit($sample_id)
    {
        $this->sample  = Sample::find($sample_id);
        $this->name    = $this->sample?->name;
        $this->profile = $this->sample?->profile;
        $this->color   = $this->sample?->color;
        $this->stock   = $this->sample?->stock;

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
                $result = Sample::find($data['inputAttributes']['id']);
                // $result->delete();
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
            'text' => 'Data Sample Telah Dihapus !'
        ]);
    }
}
