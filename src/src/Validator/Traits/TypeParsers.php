<?php

namespace App\Validator\Traits;

trait TypeParsers
{
    /**
     * @return string|int
     */
    private function tryToConvertToInteger(string $value)
    {
        if (is_numeric($value)) {
            return (int) $value;
        }

        return $value;
    }
}
