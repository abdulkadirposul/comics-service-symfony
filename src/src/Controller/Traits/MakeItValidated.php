<?php

namespace App\Controller\Traits;

use App\Validator\AbstractRequestValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait MakeItValidated
{
    /**
     * @param AbstractRequestValidator $validator
     * @param Request $request
     */
    private function validate(AbstractRequestValidator $validator, Request $request): void
    {
        if (!$validator->validate($request)) {
            throw new HttpException(422, "Input Validation Error");
        }
    }
}
