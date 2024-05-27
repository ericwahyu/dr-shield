<?php

namespace App\Livewire\Customer\CustomerPercentage;

use App\Models\Customer;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerPercentageIndex extends Component
{
    use LivewireAlert, WithPagination;
    public $perPage = 10, $search;
    public $category_percentage = 'all';

    public $start_date, $end_date;

    public function render()
    {
        $customers = Customer::search($this->search)->when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        });

        if ($this->category_percentage == "potential_customer") $customers = $customers->whereCategory('store')->whereIn('response', ['store', 'going-store-looking-stock', 'not-yet-development']);
        if ($this->category_percentage == "store_sale_done") $customers    = $customers->whereCategory('store')->whereIn('response', ['done']);
        if ($this->category_percentage == "no-response") $customers        = $customers->whereCategory('store')->whereIn('response', ['no-response']);
        if ($this->category_percentage == "store") $customers              = $customers->whereCategory('store')->whereIn('response', ['store']);
        if ($this->category_percentage == "other-product") $customers      = $customers->whereCategory('store')->whereIn('response', ['used-other-product']);

        return view('livewire.customer.customer-percentage.customer-percentage-index', [
            'customers' => $customers->paginate($this->perPage),
        ])->extends('layouts.layout.app')->section('content');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function clearFilter()
    {
        $this->reset('start_date', 'end_date');
    }

    //customer
    public function percentageCustomer()
    {
        $count_all_customer = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->count();

        if ($count_all_customer != 0 && $count_all_customer != 0) {
            $percentage_all_customer = ($count_all_customer / $count_all_customer) * 100;
        } else {
            $percentage_all_customer = 0;
        }

        return [number_format($percentage_all_customer, 2, ','), $count_all_customer];
    }

    //potential customer
    public function potentialCustomer()
    {
        $count_all_customer = Customer::count();
        $count_potential_customer = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereCategory('store')->whereIn('response', ['store', 'going-store-looking-stock', 'not-yet-development'])->count();

        if ($count_all_customer != 0 && $count_potential_customer != 0) {
            $percentage_no_response = ($count_potential_customer / $count_all_customer) * 100;
        } else {
            $percentage_no_response = 0;
        }

        return [number_format($percentage_no_response, 2, ','), $count_potential_customer];
    }

    //store sale done
    public function storeSaleDoneCustomer()
    {
        $count_all_customer = Customer::count();
        $count_store_sale_done_customer = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereCategory('store')->whereIn('response', ['done'])->count();

        if ($count_all_customer != 0 && $count_store_sale_done_customer != 0) {
            $percentage_no_response = ($count_store_sale_done_customer / $count_all_customer) * 100;
        } else {
            $percentage_no_response = 0;
        }

        return [number_format($percentage_no_response, 2, ','), $count_store_sale_done_customer];
    }

    // No Response
    public function percentageOtherProduct()
    {
        $count_all_customer = Customer::count();
        $count_customer_other_product = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereIn('response', ['used-other-product'])->count();

        if ($count_all_customer != 0 && $count_customer_other_product != 0) {
            $percentage_other_product = ($count_customer_other_product / $count_all_customer) * 100;
        } else {
            $percentage_other_product = 0;
        }

        return [number_format($percentage_other_product, 2, ','), $count_customer_other_product];
    }

    // Store
    public function percentageStore()
    {
        $count_all_customer = Customer::count();
        $count_customer_store = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereIn('response', ['store'])->count();

        if ($count_all_customer != 0 && $count_customer_store != 0) {
            $percentage_store = ($count_customer_store / $count_all_customer) * 100;
        } else {
            $percentage_store = 0;
        }

        return [number_format($percentage_store, 2, ','), $count_customer_store];
    }

    // No Response
    public function percentageNoResponse()
    {
        $count_all_customer = Customer::count();
        $count_customer_no_response = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereIn('response', ['no-response'])->count();

        if ($count_all_customer != 0 && $count_customer_no_response != 0) {
            $percentage_no_response = ($count_customer_no_response / $count_all_customer) * 100;
        } else {
            $percentage_no_response = 0;
        }

        return [number_format($percentage_no_response, 2, ','), $count_customer_no_response];
    }

    // No Response
    public function percentageNegotiation()
    {
        $count_all_customer = Customer::count();
        $count_customer_negitiation = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereIn('response', ['going-store-looking-stock', 'whatsapp', 'stock-empty-awaiting-stock', 'only-question', 'not-yet-development'])->count();

        if ($count_all_customer != 0 && $count_customer_negitiation != 0) {
            $percentage_negitiation = ($count_customer_negitiation / $count_all_customer) * 100;
        } else {
            $percentage_negitiation = 0;
        }

        return [number_format($percentage_negitiation, 2, ','), $count_customer_negitiation];
    }





    // No Response
    public function percentageDone()
    {
        $count_all_customer = Customer::count();
        $count_customer_done = Customer::when($this->start_date && $this->end_date, function ($query) {
            $query->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date);
        })->whereIn('response', ['done'])->count();

        if ($count_all_customer != 0 && $count_customer_done != 0) {
            $percentage_done = ($count_customer_done / $count_all_customer) * 100;
        } else {
            $percentage_done = 0;
        }

        return [number_format($percentage_done, 2, ','), $count_customer_done];
    }
}
