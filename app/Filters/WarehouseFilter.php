<?php

declare(strict_types=1);

namespace App\Filters;

final class WarehouseFilter extends QueryFilter
{
    public function name($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }

    public function price($value)
    {
        return $this->builder->where('price', '<=', $value);
    }

    public function color($value)
    {
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }

    public function ram($value)
    {
        return $this->builder->where('ram', 'like', '%' . $value . '%');
    }

    public function storage($value)
    {
        return $this->builder->where('storage', 'like', '%' . $value . '%');
    }

    // public function availability($value)
    // {
    //     return $this->builder->where('availability', $value);
    // }
}
