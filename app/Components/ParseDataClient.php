<?php


namespace App\Components;

use Symfony\Component\DomCrawler\Crawler;

class ParseDataClient
{
    public Crawler $crawler;
    public ImportDataClient $import;


    public function __construct(ImportDataClient $import)
    {
        $content = $import->importData();
        $this->crawler = new Crawler($content);
    }

    public function parseData(): array
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
