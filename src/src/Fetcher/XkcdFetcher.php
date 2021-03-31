<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\XkcdFetcherAbstract;
use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class XkcdFetcher extends XkcdFetcherAbstract
{
    private HttpClientInterface $client;
    private string $domain;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->domain = 'https://xkcd.com';
    }

    /**
     * @return array|int[]
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetch(): array
    {
        try {

            $currentComics = $this->performRequest($this->domain . '/info.0.json');
            if (!isset($currentComics["num"])) {
                return [];
            }

            $currentNum = $currentComics["num"];
            $returnArray = [];

            //make api calls as much as demanded with length
            $comicsCursorNum = $currentNum;
            for ($i = 0; $i < $this->length && $comicsCursorNum > 0; $i++) {
                $comicsCursorNum = $currentNum - $i;
                $comicsCursorUrl = $this->domain . "/" . $comicsCursorNum . "/info.0.json";

                $resultArray = $this->performRequest($comicsCursorUrl);
                $returnArray[] = [
                    'picture_url' => $resultArray['img'],
                    'title' => $resultArray['title'],
                    'description' => $resultArray['alt'],
                    'web_url' => $comicsCursorUrl,
                    'publishing_date' => convertToDatetime($resultArray['year'], $resultArray['month'], $resultArray['day'])
                ];
            }

        } catch (Exception $e) {
            return [];
        }

        return $returnArray;
    }

    /**
     * @param $url
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    private function performRequest($url): array
    {
        $response = $this->client->request(
            'GET',
            $url
        );

        if ($response->getStatusCode() != 200) {
            throw new Exception("Request Error");
        }

        return $response->toArray();
    }
}
