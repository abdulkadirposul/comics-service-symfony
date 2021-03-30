<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ComicsControllerIndexTest extends WebTestCase
{
    /**
     * A test to check if status code is successful
     *
     * @return void
     */
    public function testStatusCode(): void
    {
    }

    /**
     * A test to check if there are 20 pieces of comics when no params is provided
     *
     * @return void
     */
    public function testRequestHasNoParams(): void
    {

    }

    /**
     * A test to check if structure of response is [{'picture_url','title','description','web_url','publishing_date'}]
     *
     * @return void
     */
    public function testResponseStructure(): void
    {

    }

    /**
     * A test to check response length with valid parameters
     * @param $xkcdLength
     * @param $poorlyDrawLinesLength
     * @param $expectedLength
     * @dataProvider validParamsProvider
     */
    public function testRequestWithValidParams(int $xkcdLength, int $poorlyDrawLinesLength, int $expectedLength): void
    {

    }

    /**
     * A test with invalid params
     * @param $xkcdLength
     * @param $poorlyDrawLinesLength
     * @dataProvider invalidParamsProvider
     */
    public function testRequestWithInvalidParams(int $xkcdLength, int $poorlyDrawLinesLength): void
    {

    }

    /**
     * @return array
     */
    public function validParamsProvider(): array
    {
        return [
            [10, 10, 20],
            [5, 5, 10],
            [1, 1, 2]
        ];
    }

    /**
     * @return array
     */
    public function invalidParamsProvider(): array
    {
        return [
            [10, -1],
            [5, 1000],
            [-2, 10],
            [1000, 10],
        ];
    }
}
