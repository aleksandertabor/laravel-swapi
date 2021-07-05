<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Filters\Characters\NameFilter;
use App\Filters\Characters\GenderFilter;
use App\Repositories\CharacterRepositoryInterface;
use App\Http\Resources\Characters\CharacterResource;
use App\Http\Requests\Characters\FilterCharactersRequest;

class CharactersController extends Controller
{
    private $repository;

    /**
     * @param CharacterRepositoryInterface $repository
     */
    public function __construct(CharacterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FilterCharactersRequest $request
     *
     * @return \Inertia\Response
     */
    public function index(FilterCharactersRequest $request) : Response
    {
        $filters = $request->validated();

        $this->repository->addFilter(new NameFilter($filters->get('search')));
        $this->repository->addFilter(new GenderFilter($filters->get('gender')));

        $characters = $this->repository->paginate(
            10,
            ['id', 'name', 'mass', 'height', 'hair_color', 'skin_color', 'eye_color', 'birth_year', 'gender']
        );

        return Inertia::render('Characters/Index', [
            'filters' => $filters,
            'characters' => CharacterResource::collection($characters->withQueryString()),
            'genders' => $request->genders()
        ]);
    }

    /**
     * @param int $id
     *
     * @return \Inertia\Response
     */
    public function show(int $id) : Response
    {
        $character = $this->repository->getById(
            $id,
            ['id', 'name', 'mass', 'height', 'hair_color', 'skin_color', 'eye_color', 'birth_year', 'gender']
        );

        return Inertia::render('Characters/Show', [
            'character' => new CharacterResource($character)
        ]);
    }
}
