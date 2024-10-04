<?php

declare(strict_types=1);

namespace App\Filters;

final class StorageFilter extends QueryFilter
{
    public function storage($value)
    {
        return $this->builder->where('storage', 'like', '%' . $value . '%');
    }
}
