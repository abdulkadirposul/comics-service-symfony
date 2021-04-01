<?php

namespace App\Validator;

use App\Validator\Traits\TypeParsers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ComicsIndexValidator extends AbstractRequestValidator
{
    use TypeParsers;

    protected function parseRequest(Request $request): array
    {
        $returnArray = $this->prepareDefaults($request);

        if ($request->query->has('xkcd_length')) {
            $returnArray['xkcd_length'] = $this->tryToConvertToInteger($request->query->get('xkcd_length'));
        }

        if ($request->query->has('poorly_drawn_lines_length')) {
            $returnArray['poorly_drawn_lines_length'] = $this->tryToConvertToInteger($request->query->get('poorly_drawn_lines_length'));
        }

        return $returnArray;
    }

    protected function prepareConstraints(): void
    {
        $this->assertConstraints = new Assert\Collection([
            'xkcd_length' => [
                new Assert\Type("integer"),
                new Assert\Range(['min' => 0, 'max' => 30])
            ],
            'poorly_drawn_lines_length' => [
                new Assert\Type("integer"),
                new Assert\Range(['min' => 0, 'max' => 30])
            ],
        ]);
    }

    private function prepareDefaults(Request $request): array
    {
        $defaults = [
            'xkcd_length' => 10,
            'poorly_drawn_lines_length' => 10,
        ];

        if (!$request->query->has("xkcd_length")) {
            $request->query->add([
                'xkcd_length' => $defaults['xkcd_length']
            ]);
        }

        if (!$request->query->has("poorly_drawn_lines_length")) {
            $request->query->add([
                'poorly_drawn_lines_length' => $defaults['poorly_drawn_lines_length']
            ]);
        }

        return $defaults;
    }
}
