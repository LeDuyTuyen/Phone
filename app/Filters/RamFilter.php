<?php

declare(strict_types=1);

namespace App\Filters;

final class RamFilter extends QueryFilter
{
    public function ram($value)
    {
        return $this->builder->where('ram', 'like', '%' . $value . '%');
    }
}
