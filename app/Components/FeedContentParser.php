<?php


namespace App\Components;

use Symfony\Component\DomCrawler\Crawler;

class FeedContentParser
{
    public Crawler $crawler;
    public RequestHttpClient $request;


    public function __construct(RequestHttpClient $request)
    {
        $content = $request->getInstance();
        $this->crawler = new Crawler($content);
    }

    public function getNotices(): array
    {
        return $this->crawler->filterXPath('//channel//item')->each(function (
            Crawler $parentCrawler,
            $i
        ) {
            $title = $parentCrawler->filterXPath('//title');
            $link = $parentCrawler->filterXPath('//link');
            return [
                'title' => $title->text(),
                'link'=> $link->text()
            ];
        });
    }
}
