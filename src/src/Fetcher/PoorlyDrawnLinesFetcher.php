<?php

namespace App\Fetcher;

use App\Fetcher\Abstracts\PoorlyDrawnLinesFetcherAbstract;
use Exception;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PoorlyDrawnLinesFetcher extends PoorlyDrawnLinesFetcherAbstract
{
    private Crawler $crawler;
    private HttpClientInterface $client;
    private string $domain;
    private string $url;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->domain = 'http://feeds.feedburner.com';
        $this->url = $this->domain . "/PoorlyDrawnLines";
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
        $returnArray = [];

        try {
            $content = $this->performRequest($this->url);
            $this->crawler = new Crawler($content);
            $this->crawler->filter('item')->each(function (Crawler $item, $i) use (&$returnArray) {
                $returnArray[] = [
                    'picture_url' => $this->exportImage($item->filterXPath('item/content:encoded')->text()),
                    'title' => $item->filter('title')->text(),
                    'description' => $item->filter('description')->text(),
                    'web_url' => $item->filter('guid')->text(),
                    'publishing_date' => date('Y-m-d H:i:s',strtotime($item->filter('pubDate')->text()))
                ];
            });

        } catch (Exception $e) {
            return [];
        }

        return array_slice($returnArray, 0, $this->length);
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
    private function performRequest($url): string
    {
        $response = $this->client->request(
            'GET',
            $url
        );

        if ($response->getStatusCode() != 200) {
            throw new Exception("Request Error");
        }

        return $response->getContent();
    }

    private function exportImage($content): string
    {
        $html = '<!DOCTYPE html><html><body>'. $content .'</body></html>';

        $crawler = new Crawler($html);
        $image = $crawler->filterXPath('html/body/figure/a/img');
        if ($image->count() == 0) {
            $image = $crawler->filterXPath('html/body/div/figure/a/img');
        }

        return $image->first()->attr('src');
    }
}
