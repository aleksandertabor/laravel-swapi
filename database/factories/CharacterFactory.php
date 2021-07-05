<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(40),
            'born' => 19,
            'hair_color' => 'blond',
            'skin_color' => 'fair',
            'eye_color' => 'blue',
            'gender' => 'male',
            'homeworld' => url(Str::random()),
            'films' => [],
            'species' => [],
            'starships' => [],
            'vehicles' => [],
            'created' => now(),
            'edited' => now(),
            'url' => url(Str::random()),
        ];
    }
}
