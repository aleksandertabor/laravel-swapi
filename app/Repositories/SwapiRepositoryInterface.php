<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface SwapiRepositoryInterface
{
    public function getCharacters(?int $amount = null) : Collection;
    public function getFilms(?int $amount = null) : Collection;
}
