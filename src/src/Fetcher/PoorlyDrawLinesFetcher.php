<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\PoorlyDrawLinesFetcherAbstract;

final class PoorlyDrawLinesFetcher extends PoorlyDrawLinesFetcherAbstract
{

    public function fetch(): array
    {
        return [
            1,2,3,6
        ];
    }
}
