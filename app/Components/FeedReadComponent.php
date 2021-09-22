<?php

namespace App\Components;


use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class FeedRead
{
    private function get_body(): string
    {
        $response = Http::get(config('app.feeds_url'));
        return $response->body();
    }

    /**
     * @return ParseNoticeDTO[]
     */
    public function read(): array
    {
        $crawler = new Crawler($this->get_body());
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
