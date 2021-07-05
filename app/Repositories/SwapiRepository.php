<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use App\Repositories\SwapiRepositoryInterface;

class SwapiRepository implements SwapiRepositoryInterface
{
    public function getCharacters(int $number = 50)
    {
        $characters = new Collection();

        $client = Http::baseUrl("https://swapi.dev/api/")->withHeaders([
                'accept' => 'application/json',
            ])
            ->withOptions(['verify' => false]);

        $response = $client->get('people');


        if ($response->successful()) {
            $data = collect($response->json());

            $characters = $characters->concat($data->get('results'));

            while ($data->get('next') && $characters->count() < $number) {
                $response = Http::withHeaders([
                                    'accept' => 'application/json',
                                ])
                                ->withOptions(['verify' => false])
                                ->get($data->get('next'));

                if ($response->successful()) {
                    $data = collect($response->json());

                    $characters = $characters->concat($data->get('results'));
                }
            }
        }

        if ($characters->count() > $number) {
            $characters = $characters->take($number);
        }


        return $characters;
    }

    public function getFilms()
    {
        $films = new Collection();

        $client = Http::baseUrl("https://swapi.dev/api/")->withHeaders([
                'accept' => 'application/json',
            ])
            ->withOptions(['verify' => false]);

        $response = $client->get('films');


        if ($response->successful()) {
            $data = collect($response->json());

            $films = $films->concat($data->get('results'));

            while ($data->get('next')) {
                $response = Http::withHeaders([
                                    'accept' => 'application/json',
                                ])
                                ->withOptions(['verify' => false])
                                ->get($data->get('next'));

                if ($response->successful()) {
                    $data = collect($response->json());

                    $films = $films->concat($data->get('results'));
                }
            }
        }

        return $films;
    }
}
