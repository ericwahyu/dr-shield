<?php

namespace App\Livewire\MarketingTool\SampleHistory;

use App\Models\SampleHistory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SampleHistoryIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $perPage = 10, $search;

    public $filter_start_date, $filter_end_date, $filter_recap;

    public function render()
    {
        $sample_histories = SampleHistory::search($this->search)->when($this->filter_start_date && $this->filter_end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->filter_start_date)->whereDate('created_at', '<=', $this->filter_end_date);
        })->when($this->filter_recap, function ($query) {
            $query->whereType($this->filter_recap);
        });

        return view('livewire.marketing-tool.sample-history.sample-history-index', [
            'sample_histories' => $sample_histories->paginate($this->perPage)
        ])->extends('layouts.layout.app')->section('content');
    }

    public function clearFilter()
    {
        $this->reset('filter_start_date', 'filter_end_date');
    }
}
