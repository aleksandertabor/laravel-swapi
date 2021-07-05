<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use App\Repositories\SwapiRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SwapiRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_collection_with_characters()
    {
        Http::fake([
            'https://swapi.dev/api/people?page=1'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/endpoints/people/response_200.json'), true),
                200,
                ['Headers']
            )
        ]);

        $people = app(SwapiRepository::class)->getCharacters();

        $this->assertInstanceOf(Collection::class, $people);

        $character = $people->first();

        $this->assertEquals('Luke Test Skywalker', $character['name']);
        $this->assertEquals('172', $character['height']);
    }
}
