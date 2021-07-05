<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface SwapiRepositoryInterface
{
    public function getCharacters(int $number);
    public function getFilms();
}
