<?php

declare(strict_types=1);

namespace App\Filters;

final class ProductFilter extends QueryFilter
{
    public function search($value)
    {
        return $this->builder->where(function ($query) use ($value): void {
            $query->where('name', 'like', '%' . $value . '%')
                ->orWhereHas('category', function ($query) use ($value): void {
                    $query->where('name', 'like', '%' . $value . '%');
                });
        });
    }

    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }

    public function category($value)
    {
        return $this->builder->where('category_id', $value);
    }

    public function price($value)
    {
        return $this->builder->where('price', '<=', $value);
    }

    public function availability($value)
    {
        return $this->builder->where('availability', $value);
    }
}
