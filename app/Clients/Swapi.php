<?php

namespace App\Clients;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;

class Swapi
{
    public const ENDPOINT_PEOPLE = 'people';
    public const ENDPOINT_FILMS = 'films';

    /**
     * @param PendingRequest $connection
     */
    public function __construct(private PendingRequest $connection)
    {
    }

    /**
     * Get resources from given endpoint (you can specify or by default you will get all)
     *
     * @param string $endpoint
     * @param int|null $amount
     *
     * @return Collection
     */
    public function getResources(string $endpoint, ?int $amount = null) : Collection
    {
        $response = $this->get($endpoint, $page = 1);

        $resources = new Collection();

        if ($response->successful()) {
            $resources = $resources->concat($response->json('results'));

            while ($response->json('next') && (!$amount || $resources->count() < $amount)) {
                $response = $this->get($endpoint, $page += 1);

                if ($response->successful()) {
                    $resources = $resources->concat($response->json('results'));
                }
            }
        }

        if ($amount && $resources->count() > $amount) {
            $resources = $resources->take($amount);
        }

        return $resources;
    }


    /**
     * Get single resource from given endpoint and id of specific resource.
     *
     * @param string $endpoint
     * @param int $id
     *
     * @return array|null
     */
    public function getResource(string $endpoint, int $id) : ?array
    {
        $response  = $this->connection->get("{$endpoint}/{$id}");

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }


    /**
     * Wrapper for get() from HTTP client
     *
     * @param string $endpoint
     * @param int|null $page
     *
     * @return Response
     */
    protected function get(string $endpoint, ?int $page = null) : Response
    {
        $response  = $this->connection->get($endpoint, $page ? [
            'page' => $page
        ] : null);

        return $response;
    }
}
