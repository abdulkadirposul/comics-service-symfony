<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\XkcdFetcherAbstract;

final class XkcdFetcher extends XkcdFetcherAbstract
{
    public function fetch(): array
    {
        return [1,2,3];
    }
}
