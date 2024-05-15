<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Order\OrderRoof\OrderRoofIndex;
use App\Models\Customer;
use App\Models\OrderHistory;
use App\Models\Product;
use Livewire\Component;

class DashboardIndex extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashboard-index')->extends('layouts.layout.app')->section('content');
    }

    public function countAllCustomer()
    {
        $count_all_customer = Customer::count();

        return $count_all_customer;
    }

    public function countNoResponse()
    {
        $count_no_response_customer =  Customer::whereIn('response', ['no-response'])->count();

        return $count_no_response_customer;
    }

    public function countNegotiation()
    {
        $count_negotiation_customer =  Customer::whereIn('response', ['going-store-looking-stock', 'whatsapp', 'stock-empty-awaiting-stock', 'only-question', 'not-yet-development'])->count();

        return $count_negotiation_customer;
    }

    public function countStore()
    {
        $count_store_customer =  Customer::whereIn('response', ['store'])->count();

        return $count_store_customer;
    }

    public function countOtherProduct()
    {
        $count_other_product_customer =  Customer::whereIn('response', ['used-other-product'])->count();

        return $count_other_product_customer;
    }

    public function countDone()
    {
        $count_done_customer =  Customer::whereIn('response', ['done'])->count();

        return $count_done_customer;
    }

    public function countAllOrder()
    {
        $count_all_order = OrderHistory::count();

        return $count_all_order;
    }

    public function countRoofOrder()
    {
        $count_roof_order = OrderHistory::whereHas('product', function ($query){
            $query->whereCalculated('proof');
        })->count();

        return $count_roof_order;
    }

    public function countUpvcOrder()
    {
        $count_upvc_order = OrderHistory::whereHas('product', function ($query){
            $query->whereCalculated('upvc');
        })->count();

        return $count_upvc_order;
    }

    public function productRoof()
    {
        $count_roof = Product::whereCalculated('proof')->count();

        return $count_roof;
    }

    public function productUpvc()
    {
        $count_upvc = Product::whereCalculated('upvc')->count();

        return $count_upvc;
    }
}
