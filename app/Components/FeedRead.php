<?php

namespace App\Components;

use JetBrains\PhpStorm\Pure;
use Symfony\Component\DomCrawler\Crawler;

class FeedRead
{
    private RequestHttpClient $client;

    public function __construct(RequestHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return ParseNoticeDTO[]
     */
    public function read(): array
    {
        $crawler = new Crawler($this->client->get_body());
        return $crawler->filterXPath('//channel//item')->each(function (
            Crawler $parentCrawler,
                    $i
        ) {
            $title = $parentCrawler->filterXPath('//title');
            $link = $parentCrawler->filterXPath('//link');
            return new ParseNoticeDTO($title->text(), $link->text());
        });
    }

}
