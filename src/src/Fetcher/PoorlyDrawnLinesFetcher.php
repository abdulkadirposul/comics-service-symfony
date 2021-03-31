<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\PoorlyDrawnLinesFetcherAbstract;

final class PoorlyDrawnLinesFetcher extends PoorlyDrawnLinesFetcherAbstract
{

    public function fetch(): array
    {
        return [
            1,2,3,6
        ];
    }
}
