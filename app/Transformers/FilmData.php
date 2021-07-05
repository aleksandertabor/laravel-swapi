<?php

namespace App\Transformers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class FilmData
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
                'api_id' => Str::of($item->get('url'))->basename(),
                'title' => $item->get('title'),
                'characters' => json_encode($item->get('characters')),
                'url' => $item->get('url'),
            ];
        });

        return $data;
    }
}
