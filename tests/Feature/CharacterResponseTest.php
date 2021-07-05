<?php

namespace Tests\Feature;

use App\Models\Character;
use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CharacterResponseTest extends TestCase
{
    use RefreshDatabase;

    public function test_characters_page_has_index_component()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/characters');

        $response->assertInertia(fn (Assert $page) => $page->component('Characters/Index'));
    }

    public function test_character_page_has_show_component()
    {
        $user = User::factory()->create();

        $character = Character::factory()->create();

        $response = $this->actingAs($user)->get("/characters/{$character->id}");

        $response->assertInertia(fn (Assert $page) => $page->component('Characters/Show'));
    }

    public function test_single_character_has_character_property()
    {
        $user = User::factory()->create();

        $character = Character::factory()->create();

        $response = $this->actingAs($user)->get("/characters/{$character->id}");

        $response->assertInertia(fn (Assert $page) => $page
            ->has('character')
            ->has('character.id')
        );
    }

    public function test_characters_page_has_characters_data()
    {
        $user = User::factory()->create();

        $characters = Character::factory(10)->create();

        $response = $this->actingAs($user)->get('/characters');

        $response->assertInertia(fn (Assert $page) => $page
            ->has('characters.data', $characters->count())
        );
    }
}
