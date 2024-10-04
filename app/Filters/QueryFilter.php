<?php

declare(strict_types=1);

namespace App\Filters;

abstract class QueryFilter
{
    protected $request;

    protected $builder;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {   
        $this->builder = $builder;
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->{$filter}($value);
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
