<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleHistory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = ['id'];

    public function scopeSearch(Builder $query, $term): void
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->whereAny(['value'], 'LIKE', $term)
            ->orwhereHas('sample', function ($query) use ($term) {
                $query->whereAny(['name', 'profile', 'color'], 'LIKE', $term);
            });
        });
    }

    public function sample()
    {
        return $this->belongsTo(Sample::class, 'sample_id', 'id');
    }
}
