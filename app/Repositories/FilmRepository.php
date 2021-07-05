<?php

namespace App\Repositories;

use App\Models\Film;
use App\Models\Character;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Repositories\FilmRepositoryInterface;

class FilmRepository implements FilmRepositoryInterface
{
    /**
     * @var Film
     */
    private $model;

    /**
     * CharacterRepository constructor.
     *
     * @param Character $model
     * @param Collection $filters
     */
    public function __construct(Film $model, private Collection $filters)
    {
        $this->model = $model;
    }

    /**
     * @param Collection $data
     *
     * @return void
     */
    public function upsert(Collection $data) : void
    {
        $this->model->upsert($data->toArray(), ['api_id']);
    }
}
