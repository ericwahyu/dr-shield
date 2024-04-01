<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderHistory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = ['id'];

    public function scopeSearch(Builder $query, $term): void
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->whereAny(['length', 'width'], 'LIKE', $term)
                ->orWhereHas('product', function ($query) use ($term) {
                    $query->whereAny(['name', 'profile'], 'LIKE', $term);
                });
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
