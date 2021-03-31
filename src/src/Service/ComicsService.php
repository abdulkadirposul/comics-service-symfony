<?php

namespace App\Service;

use App\Fetcher\Abstracts\FetcherAbstract;
use App\Service\Contracts\ComicsServiceContract;

class ComicsService implements ComicsServiceContract
{
    public function getComics(array $fetchers)
    {
        /** @var FetcherAbstract $fetcher */
        foreach ($fetchers as  $fetcher) {
            dump($fetcher->fetch());
        }
    }
}
