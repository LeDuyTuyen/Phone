<?php

declare(strict_types=1);

namespace App\Filters;

final class CategoryFilter extends QueryFilter
{
    public function category($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
}
