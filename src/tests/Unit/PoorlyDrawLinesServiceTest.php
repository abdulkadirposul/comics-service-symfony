<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

final class PoorlyDrawLinesServiceTest extends TestCase
{
    /**
     * This tests the service if it can succeed the http request
     *
     * @return void
     */
    public function testHttpRequest(): void
    {
    }

    /**
     * This tests if the service returns as many item as demanded
     *
     * @param int $actualLength
     * @param int $expectedLength
     * @return void
     */
    public function testWithLengthParams(int $actualLength, int $expectedLength): void
    {

    }

    /**
     * This tests the result's structure
     *
     * @return void
     */
    public function testResultStructure(): void
    {

    }

    /**
     * This is a data provider to simulate test with different conditions
     *
     * @return array
     */
    public function lengthParamsDataProvider(): array
    {
        return [
            [5, 5]
        ];
    }
}
