<?php

namespace App\Fetcher;

class FetcherPreparer
{
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
    private function handleXkcdFetcher(int $xkcdLength): XkcdFetcher
    {
        $xkcdFetcher = new XkcdFetcher();
        $xkcdFetcher->setLength($xkcdLength);
        return $xkcdFetcher;
    }

    /**
     * @param int $poorlyDrawnLinesLength
     * @return PoorlyDrawLinesFetcher
     */
    private function handlePoorlyDrawLinesFetcher(int $poorlyDrawnLinesLength): PoorlyDrawLinesFetcher
    {
        $poorlyDrawnLinesFetcher = new PoorlyDrawLinesFetcher();
        $poorlyDrawnLinesFetcher->setLength($poorlyDrawnLinesLength);
        return $poorlyDrawnLinesFetcher;
    }
}
