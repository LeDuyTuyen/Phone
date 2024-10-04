<?php

declare(strict_types=1);

namespace App\Filters;

final class ColorFilter extends QueryFilter
{
    public function color($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }
}
