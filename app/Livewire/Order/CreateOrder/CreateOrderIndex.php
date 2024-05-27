<?php

namespace App\Livewire\Order\CreateOrder;

use App\Models\Customer;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateOrderIndex extends Component
{
    use LivewireAlert;
    public $customer_id, $order_date, $product_id, $length, $width, $pieces;
    public $get_product;
    // calculated
    public $length_mm, $width_mm, $length_product, $width_product;
    public $length_value_1, $width_value_1;
    public $length_roundup, $width_roundup;
    public $count_item, $count_item_roundup;
    public $grand_total;

    public $effective_width_product, $rate, $rate_roundup;
    public $width_value_2, $width_roundupx2;

    public $data_orders = array(), $final_price;

    public function render()
    {
        $this->get_product = Product::find($this->product_id);

        if ($this->get_product?->calculated == 'proof' && $this->length && $this->width) {
            //1
            $this->length_mm      = $this->length * 1000;
            $this->width_mm       = $this->width * 1000;
            $this->length_product = $this->get_product?->effective_length;
            $this->width_product  = $this->get_product?->effective_width;

            //2
            $this->length_value_1 = number_format($this->length_mm / $this->length_product, 2, ',', '.');
            $this->width_value_1  = number_format($this->width_mm / $this->width_product, 2, ',', '.');

            //3
            if (number_format($this->length_mm / $this->length_product, 2) > number_format($this->length_mm / $this->length_product, 0)) {
                $this->length_roundup = number_format($this->length_mm / $this->length_product, 0) + 1;
            } else {
                $this->length_roundup = number_format($this->length_mm / $this->length_product, 0);
            }

            if (number_format($this->width_mm / $this->width_product, 2) > number_format($this->width_mm / $this->width_product, 0)) {
                $this->width_roundup = number_format($this->width_mm / $this->width_product, 0) + 1;
            } else {
                $this->width_roundup = number_format($this->width_mm / $this->width_product, 0);
            }

            //4
            $this->count_item = $this->length_roundup * $this->width_roundup;

            //5
            $this->grand_total = $this->count_item * $this->get_product?->price;
        } elseif ($this->get_product?->calculated == 'upvc' && $this->length && $this->width) {
            if ($this->length > 12) {
                //1
                $this->rate = $this->length / 12;
                if (number_format($this->length / 12, 2) > number_format($this->length / 12, 0)) {
                    $this->rate_roundup = number_format($this->length / 12, 0) + 1;
                } else {
                    $this->rate_roundup = number_format($this->length / 12, 0);
                }

                $this->width_mm       = $this->width * 1000;
                $this->effective_width_product = $this->get_product?->effective_width;

                //2
                $this->length_value_1 = number_format($this->length / $this->rate_roundup, 2, ',', '.');
                $this->width_value_1 = number_format($this->width_mm / $this->effective_width_product, 2, ',', '.');

                //3
                if (number_format($this->length / $this->rate_roundup, 2) > number_format($this->length / $this->rate_roundup, 0)) {
                    $this->length_roundup = number_format($this->length / $this->rate_roundup, 0) + 1;
                } else {
                    $this->length_roundup = number_format($this->length / $this->rate_roundup, 0);
                }

                if (number_format($this->width_mm / $this->effective_width_product, 2) > number_format($this->width_mm / $this->effective_width_product, 0)) {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0) + 1;
                } else {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0);
                }

                //4
                $this->width_roundupx2 = $this->width_roundup * $this->rate_roundup;

                //5
                $this->count_item = $this->length_roundup * $this->width_roundupx2;

                //6
                $this->grand_total = $this->count_item * $this->get_product?->price;
            } else {
                //1
                $this->width_mm       = $this->width * 1000;
                $this->effective_width_product = $this->get_product?->effective_width;

                //2
                $this->width_value_2 = number_format($this->width_mm / $this->effective_width_product, 2, ',', '.');

                //3
                if (number_format($this->width_mm / $this->effective_width_product, 2) > number_format($this->width_mm / $this->effective_width_product, 0)) {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0) + 1;
                } else {
                    $this->width_roundup = number_format($this->width_mm / $this->effective_width_product, 0);
                }

                //4
                $this->count_item = $this->length * $this->width_roundup;

                //5
                $this->grand_total = $this->count_item * $this->get_product?->price;
            }
        } elseif ($this->get_product?->calculated == 'accessories' && $this->width){
            //1
            // $this->length_mm      = $this->length * 1000;
            $this->width_mm       = $this->width * 1000;
            $this->width_product  = $this->get_product?->effective_width;

            //2
            $this->count_item = $this->width_mm / $this->width_product;

            //2
            if(number_format($this->width_mm / $this->width_product, 2) > number_format($this->width_mm / $this->width_product, 0)){
                $this->count_item_roundup = number_format($this->width_mm / $this->width_product, 0) + 1;
            }else{
                $this->count_item_roundup = number_format($this->width_mm / $this->width_product, 0);
            }

            //3
            $this->grand_total = $this->count_item_roundup * $this->get_product?->price;

        } elseif ($this->get_product?->calculated == 'pieces' && $this->pieces){
            //1
            $this->grand_total = $this->pieces * $this->get_product?->price;
        }

        return view('livewire.order.create-order.create-order-index', [
            'customers' => Customer::whereResponse('done')->get(),
            'products'  => Product::all(),
        ])->extends('layouts.layout.app')->section('content');
    }

    public function mount()
    {
        $this->order_date = Carbon::now()->format('Y-m-d');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addDataOrder()
    {
        $need = $size = $quantity = null;
        //need
        if(in_array(Product::find($this->product_id)?->calculated, ['proof', 'upvc'])){
            $need = $this->length && $this->width ? $this->length . 'm x ' . $this->width . 'm' : null;
        } elseif (in_array(Product::find($this->product_id)?->calculated, ['accessories', 'pieces'])) {
            $need = $this->width ? $this->width . 'm' : null;;
        }
        //size
        if (Product::find($this->product_id)?->calculated == 'proof') {
            $size = null;
        } elseif (Product::find($this->product_id)?->calculated == 'upvc') {
            if($this->length > 12){
                $size = $this->length_roundup;
            } else {
                $size = $this->length;
            }
        }
        //quantity
        if (Product::find($this->product_id)?->calculated == 'proof') {
            $quantity = $this->count_item;
        } elseif (Product::find($this->product_id)?->calculated == 'upvc') {
            if($this->length > 12){
                $quantity = $this->width_roundupx2;
            } else {
                $quantity = $this->width_roundup;
            }
        } elseif (Product::find($this->product_id)?->calculated == 'accessories'){
            $quantity = $this->count_item_roundup;
        } elseif (Product::find($this->product_id)?->calculated == 'pieces'){
            $quantity = $this->pieces;
        }

        $array_order = array(
            'product_id'      => $this->product_id,
            'product_name'    => Product::find($this->product_id) != null ? Product::find($this->product_id)->name : '-',
            'product_profile' => Product::find($this->product_id) != null ? Product::find($this->product_id)->profile : '',
            'need'            => $need,
            'size'            => $size,
            'quantity'        => $quantity,
            'quantity_unit'   => in_array(Product::find($this->product_id)->price_unit, ['M', 'Lembar']) ? 'Lembar' : 'Pack (40 Pcs)',
            'price'           => Product::find($this->product_id) != null ? Product::find($this->product_id)->price : 0,
            'price_unit'      => Product::find($this->product_id)->price_unit == 'M' ? "M'" : (Product::find($this->product_id)->price_unit == '40 pcs' ? "Pack (40 pcs)" : Product::find($this->product_id)->price_unit),
            'total_price'     => $this->grand_total,
        );
        array_push($this->data_orders, $array_order);
        $array_order = array();
        $this->final_price += $this->grand_total;
        $this->reset('product_id', 'length', 'width', 'grand_total');
    }

    public function saveDataOrder()
    {
        $this->validate([
            'customer_id' => 'required',
            'order_date'  => 'required|date',
            'data_orders' => 'required',
        ]);

        DB::transaction(function () {
            $order = Order::create([
                'customer_id' => $this->customer_id,
                'order_code'  => 'ODR/' . Carbon::now()->format('ym') . '/' . rand(1111, 9999),
                'order_date'  => $this->order_date,
            ]);

            foreach ($this->data_orders as $data_order) {
                OrderDetail::create([
                    'order_id'      => $order?->id,
                    'product_id'    => $data_order['product_id'],
                    'need'          => $data_order['need'],
                    'size'          => $data_order['size'],
                    'quantity'      => $data_order['quantity'],
                    'quantity_unit' => $data_order['quantity_unit'],
                    'price'         => $data_order['price'],
                    'price_unit'    => Product::find($data_order['product_id'])->price_unit,
                    'total_price'   => $data_order['total_price'],
                ]);
            }
        });
        try {
            //code...
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            Log::error($th->getMessage());

            return $this->alert('error', 'Maaf', [
                'text' => 'Terjadi Kesalahan Saat Menyimpan Data!'
            ]);
        }

        $this->reset('product_id', 'length', 'width', 'grand_total', 'final_price', 'data_orders', 'customer_id');

        return $this->alert('success', 'Berhasil', [
            'text' => 'Data Pelanggan Telah Disimpan !'
        ]);
    }

    public function deleteConfirm($id)
    {
        $this->confirm('Konfirmasi', [
            'inputAttributes'    => ['id' => $id],
            'onConfirmed'        => 'deleteDataOrder',
            'text'               => 'Data yang dihapus tidak dapat di kembalikan lagi',
            'reverseButtons'     => 'true',
            'confirmButtonColor' => '#24B464',
        ]);
    }

    public function getListeners()
    {
        return ['deleteDataOrder'];
    }

    public function deleteDataOrder($data)
    {
        // dd($data['inputAttributes']['id']);
        unset($this->data_orders[$data['inputAttributes']['id']]);

        return $this->alert('success', 'Berhasil', [
            'text' => 'Data pesanan telah di hapus !'
        ]);
    }
}
