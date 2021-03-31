<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\PoorlyDrawnLinesFetcherAbstract;
use App\Fetcher\Abstracts\XkcdFetcherAbstract;

class FetcherPreparer
{
    private XkcdFetcherAbstract $xkcdFetcher;
    private PoorlyDrawnLinesFetcherAbstract $poorlyDrawnLinesFetcher;

    public function __construct(
        XkcdFetcherAbstract $xkcdFetcher,
        PoorlyDrawnLinesFetcherAbstract $poorlyDrawnLinesFetcher
    )
    {
        $this->xkcdFetcher = $xkcdFetcher;
        $this->poorlyDrawnLinesFetcher = $poorlyDrawnLinesFetcher;
    }

    public function handle(array $params): array
    {
        $returnArray = [];

        $returnArray[] = $this->handleXkcdFetcher((int) $params["xkcd_length"]);
        $returnArray[] = $this->handlePoorlyDrawLinesFetcher((int) $params["poorly_drawn_lines_length"]);


        return $returnArray;
    }

    /**
     * @param int $xkcdLength
     * @return XkcdFetcher
     */
    private function handleXkcdFetcher(int $xkcdLength): XkcdFetcherAbstract
    {
        $this->xkcdFetcher->setLength($xkcdLength);
        return $this->xkcdFetcher;
    }

    /**
     * @param int $poorlyDrawnLinesLength
     * @return PoorlyDrawnLinesFetcher
     */
    private function handlePoorlyDrawLinesFetcher(int $poorlyDrawnLinesLength): PoorlyDrawnLinesFetcherAbstract
    {
        $this->poorlyDrawnLinesFetcher->setLength($poorlyDrawnLinesLength);
        return $this->poorlyDrawnLinesFetcher;
    }
}
