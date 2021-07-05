<?php

namespace App\Jobs;

use App\Models\Film;
use App\Models\Character;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

/**
 * Job synchronises ManyToMany relationship between films and characters.
 */
class SynchroniseFilmsWithCharacters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Film::cursor() as $film) {
            $characters = $film->characters->transform(function ($item, $key) {
                $apiId = (int) (string) Str::of($item)->basename();
                return optional(Character::where('api_id', $apiId)->first())->id;
            })->filter()->toArray();

            $film->heroes()->sync($characters);
        }
    }
}
