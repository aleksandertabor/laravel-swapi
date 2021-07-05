<?php

namespace App\Filters\Characters;

use App\Filters\Filter;

class NameFilter implements Filter
{
    public function __construct(public ?string $name)
    {
    }

    public function apply($query)
    {
        return $this->name ? $query->where('name', 'like', '%'.$this->name.'%') : $query;
    }
}
