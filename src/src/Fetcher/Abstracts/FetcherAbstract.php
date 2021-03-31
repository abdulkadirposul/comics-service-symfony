<?php

namespace App\Fetcher\Abstracts;

abstract class FetcherAbstract
{
    protected int $length;

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public abstract function fetch(): array;
}
