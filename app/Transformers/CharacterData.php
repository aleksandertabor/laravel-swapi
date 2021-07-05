<?php

namespace App\Transformers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

/**
 * Basic "transformer"/"wrapper" for data before saving to database.
 *
 * DataTransferObjects will be better :)
 */
class CharacterData
{
    /**
     * @param Collection $data
     *
     * @return Collection
     */
    public static function fromApi(Collection $data) : Collection
    {
        $data->transform(function ($item, $key) {
            $item = collect($item);

            return [
                'name' => $item->get('name'),
                'api_id' => Str::of($item->get('url'))->basename(),
                'height' => is_numeric($item->get('height')) ? $item->get('height') : null,
                'mass' => is_numeric($item->get('mass')) ? $item->get('mass') : null,
                'born' => $item->get('birth_year') != 'unknown' ? self::transformYear($item->get('birth_year')) : null,
                'hair_color' => $item->get('hair_color'),
                'skin_color' => $item->get('skin_color'),
                'eye_color' => $item->get('eye_color'),
                'gender' => $item->get('gender'),
                'homeworld' => $item->get('homeworld'),
                'films' => json_encode($item->get('films')),
                'species' => json_encode($item->get('species')),
                'starships' => json_encode($item->get('starships')),
                'vehicles' => json_encode($item->get('vehicles')),
                'created' => Carbon::parse($item->get('created')),
                'edited' => Carbon::parse($item->get('edited')),
                'url' => $item->get('url'),
            ];
        });

        return $data;
    }

    /**
     * Transform year from Star Wars time system
     *
     * BBY - before the Battle of Yavin
     * ABY - after the Battle of Yavin
     *
     * Example 1: 19BBY -> -19
     * Example 2: 20ABY -> 20
     *
     * @param string $born
     *
     * @return int|float
     */
    public static function transformYear(string $born) : int|float
    {
        if (Str::contains($born, 'BBY')) {
            $born = Str::replace('BBY', '', $born);
            $born = -abs($born);
        }

        if (Str::contains($born, 'ABY')) {
            $born = Str::replace('ABY', '', $born);
        }

        return $born;
    }
}
