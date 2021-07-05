<?php

namespace App\Repositories;

use App\Models\Character;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CharacterRepositoryInterface
{
    public function getById(int $id, $columns = ['*']) : Character;
    public function paginate($perPage = 10, $columns = ['*']) : LengthAwarePaginator;
    public function upsert(Collection $data) : void;
    public function update(int $id, Collection $data) : void;
}
