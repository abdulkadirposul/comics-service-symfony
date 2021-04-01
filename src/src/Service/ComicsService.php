<?php

namespace App\Service;

use App\Fetcher\Abstracts\FetcherAbstract;
use App\Service\Contracts\ComicsServiceContract;

class ComicsService implements ComicsServiceContract
{
    public function getComics(array $fetchers)
    {
        $returnArray = [];

        /** @var FetcherAbstract $fetcher */
        foreach ($fetchers as  $fetcher) {
            $returnArray = array_merge($returnArray, $fetcher->fetch());
        }

        dd($returnArray);
        return $returnArray;
    }
}
