<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\XkcdFetcherAbstract;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class XkcdFetcher extends XkcdFetcherAbstract
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetch(): array
    {
        $response = $this->client->request(
            'GET',
            'https://xkcd.com/info.0.json'
        );
        dd($response);
        return [1,2,3];
    }
}
