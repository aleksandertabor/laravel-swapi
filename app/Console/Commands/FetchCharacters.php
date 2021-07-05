<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Transformers\CharacterData;
use App\Jobs\SynchroniseFilmsWithCharacters;
use App\Repositories\FilmRepositoryInterface;
use App\Repositories\SwapiRepositoryInterface;
use App\Repositories\CharacterRepositoryInterface;
use App\Transformers\FilmData;

class FetchCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:fetch-characters {amount=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update/save (upsert) characters from SWAPI (swapi.dev/api/people).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param SwapiRepositoryInterface $swapiRepository
     * @param CharacterRepositoryInterface $characterRepository
     * @param FilmRepositoryInterface $filmRepository
     *
     * @return void
     */
    public function handle(SwapiRepositoryInterface $swapiRepository, CharacterRepositoryInterface $characterRepository, FilmRepositoryInterface $filmRepository) : void
    {
        $this->comment("Start fetching characters...");

        try {
            $characters = $swapiRepository->getCharacters($this->argument('amount'));

            $characterRepository->upsert(CharacterData::fromApi($characters));

            $films = $swapiRepository->getFilms();

            $filmRepository->upsert(FilmData::fromApi($films));

            SynchroniseFilmsWithCharacters::dispatch();

            $this->info("Fetched {$characters->count()} characters.");
        } catch (Exception $e) {
            $this->error("Error: {$e->getMessage()}");
        }
    }
}
