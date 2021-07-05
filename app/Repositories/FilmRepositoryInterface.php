<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface FilmRepositoryInterface
{
    public function upsert(Collection $data) : void;
}
