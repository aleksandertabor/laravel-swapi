<?php

namespace App\Filters\Characters;

use App\Filters\Filter;

class GenderFilter implements Filter
{
    public function __construct(public ?string $gender)
    {
    }

    public function apply($query)
    {
        return $this->gender ? $query->where('gender', $this->gender) : $query;
    }
}
