<?php

namespace App\Components\Services;

use App\Components\ParseNoticeDTO;
use App\Contracts\IFeedRead;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class FeedReedHabr implements IFeedRead
{
    private function getBody(): string
    {
        $response = Http::get(config('app.feeds_url_habr'));
        return $response->body();
    }
    /**
     * @return ParseNoticeDTO[]
     */
    public function read(): array
    {
        $crawler = new Crawler($this->getBody());
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
