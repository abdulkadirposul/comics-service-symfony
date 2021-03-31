<?php

namespace App\Service\Contracts;

interface ComicsServiceContract
{
    public function getComics(array $fetchers);
}
