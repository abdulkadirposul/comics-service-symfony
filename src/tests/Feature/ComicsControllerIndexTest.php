<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ComicsControllerIndexTest extends WebTestCase
{
    private static string $url;

    public static function setUpBeforeClass(): void
    {
        self::$url = "/comics";
    }

    /**
     * A test to check if status code is successful
     *
     * @return void
     */
    public function testStatusCode(): void
    {
        $client = ComicsControllerIndexTest::createClient();
        $client->request('GET', self::$url);

        $this->assertResponseIsSuccessful();
    }

    /**
     * A test to check if there are 20 pieces of comics when no params is provided
     *
     * @return void
     */
    public function testRequestHasNoParams(): void
    {
        $client = ComicsControllerIndexTest::createClient();
        $client->request('GET', self::$url);
        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertSame(20, count($response));

    }

    /**
     * A test to check if structure of response is [{'picture_url','title','description','web_url','publishing_date'}]
     *
     * @return void
     */
    public function testResponseStructure(): void
    {
        $url = self::$url . "?xkcd_length=1&poorly_drawn_lines_length=1";
        $client = ComicsControllerIndexTest::createClient();
        $client->request('GET', $url);
        $response = json_decode($client->getResponse()->getContent(), true);

        foreach ($response as $item) {
            $this->assertTrue(isset($item["picture_url"]));
            $this->assertTrue(isset($item["title"]));
            $this->assertTrue(isset($item["description"]));
            $this->assertTrue(isset($item["web_url"]));
            $this->assertTrue(isset($item["publishing_date"]));
        }
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
        $url = self::$url . "?xkcd_length=".$xkcdLength . "&poorly_drawn_lines_length=".$poorlyDrawLinesLength;
        $client = ComicsControllerIndexTest::createClient();
        $client->request('GET', $url);
        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertSame($expectedLength, count($response));
    }

    /**
     * A test with invalid params
     * @param $xkcdLength
     * @param $poorlyDrawLinesLength
     * @dataProvider invalidParamsProvider
     */
    public function testRequestWithInvalidParams(int $xkcdLength, int $poorlyDrawLinesLength): void
    {
        $url = self::$url . "?xkcd_length=".$xkcdLength . "&poorly_drawn_lines_length=".$poorlyDrawLinesLength;
        $client = ComicsControllerIndexTest::createClient();
        $client->request('GET', $url);

        $this->assertResponseStatusCodeSame(422);
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
