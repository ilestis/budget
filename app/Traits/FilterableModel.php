<?php

namespace App\Traits;

use App\Filters\Types\Filter;


trait FilterableModel
{
    public function filter(Filter $filter)
    {
        foreach ($filter->value() as $field => $value) {
            if (array_key_exists($field, $this->attributes)) {
                dd($field);
                $this->where($field, $value);
            }
        }

        return $this;
    }
}