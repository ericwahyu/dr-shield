<?php

namespace App\Models\Order;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'order_date' => 'date',
        'print_at'   => 'date',
    ];

    public function scopeSearch(Builder $query, $term): void
    {
        $term = "%$term%";

        $query->orWhere('order_code', 'LIKE', $term)
        ->whereHas('customer', function ($query) use ($term) {
            $query->whereAny(['name', 'needs', 'phone', 'address', 'store', 'description'], 'LIKE', $term);
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
