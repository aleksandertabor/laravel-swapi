<?php

namespace App\Http\Resources\Characters;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mass' => $this->mass,
            'height' => $this->height,
            'hair_color' => $this->hair_color,
            'skin_color' => $this->skin_color,
            'eye_color' => $this->eye_color,
            'gender' => $this->gender,
            'culture' => $this->culture,
            'born' => $this->born,
            'died' => $this->died,
            'titles' => $this->whenLoaded('movies', function () {
                return $this->movies->pluck('title');
            })
        ];
    }
}
