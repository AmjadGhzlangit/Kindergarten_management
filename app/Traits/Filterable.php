<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['first_name'] ?? false, function ($builder, $value) {
            $builder->where('first_name', 'like', "%{$value}%");
        });

        $builder->when($filters['type'] ?? false, function ($builder, $value) {
            $builder->where('type', '=', $value);
        });

       
    }
}
