<?php

namespace App\Validator;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractRequestValidator
{
    protected Assert\Collection $assertConstraints;

    public function validate(Request $request): bool
    {
        try {
            $this->prepareConstraints();
            $validator = Validation::createValidator();
            $errors = $validator->validate($this->parseRequest($request), $this->assertConstraints);

            if (count($errors) > 0) {
                return false;
            }

            return true;
        }
        catch (Exception $exception) {
            return false;
        }
    }

    protected abstract function parseRequest(Request $request): array;

    protected abstract function prepareConstraints(): void;
}
