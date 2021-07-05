<?php

namespace App\Repositories;

use App\Clients\Swapi;
use Illuminate\Support\Collection;
use App\Repositories\SwapiRepositoryInterface;

class SwapiRepository implements SwapiRepositoryInterface
{
    /**
     * SwapiRepository constructor.
     * @param Swapi $swapi
     */
    public function __construct(private Swapi $swapi)
    {
    }

    /**
     * @param int|null $amount
     *
     * @return Collection
     */
    public function getCharacters(?int $amount = null) : Collection
    {
        return $this->swapi->getResources(Swapi::ENDPOINT_PEOPLE, amount: $amount);
    }

    /**
     * @param int|null $amount
     *
     * @return Collection
     */
    public function getFilms(?int $amount = null) : Collection
    {
        return $this->swapi->getResources(Swapi::ENDPOINT_FILMS, amount: $amount);
    }
}
