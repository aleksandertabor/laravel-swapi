<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Filters\Filter;
use App\Models\Character;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{
    /**
     * @var Character
     */
    private $model;

    /**
     * CharacterRepository constructor.
     *
     * @param Character $model
     * @param Collection $filters
     */
    public function __construct(Character $model, private Collection $filters)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @param array $columns
     *
     * @return Character
     */
    public function getById(int $id, array $columns = ['*']) : Character
    {
        $this->applyFilters();

        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     *
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 10, array $columns = ['*']) : LengthAwarePaginator
    {
        $this->applyFilters();

        return $this->model->paginate($perPage, $columns);
    }


    /**
     * @param Collection $data
     *
     * @return void
     */
    public function upsert(Collection $data) : void
    {
        $data->transform(function ($item, $key) {
            return array_merge($item, [
                'api_id' => Str::of($item['url'])->basename(),
                'films' => json_encode($item['films']),
                'species' => json_encode($item['species']),
                'starships' => json_encode($item['starships']),
                'vehicles' => json_encode($item['vehicles']),
                'created' => Carbon::parse($item['created']),
                'edited' => Carbon::parse($item['edited']),
            ]);
        });

        $this->model->upsert($data->toArray(), ['api_id']);
    }

    /**
     * @param int $id
     * @param Collection $data
     *
     * @return void
     */
    public function update(int $id, Collection $data) : void
    {
        $customer = $this->getById($id);

        $customer->update($data->toArray());
    }

    /**
     * @param Filter $filter
     *
     * @return void
     */
    public function addFilter(Filter $filter) : void
    {
        $this->filters->push($filter);
    }

    /**
     * @return void
     */
    protected function applyFilters() : void
    {
        foreach ($this->filters as $filter) {
            if ($filter instanceof Filter) {
                $this->model = $filter->apply($this->model);
            }
        }
    }
}
