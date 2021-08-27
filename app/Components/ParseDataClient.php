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

    public function parseData()
    {
        $textContent =  $this->crawler->filterXPath('//channel//item//title');

        $data = [];

        foreach ($textContent as $domElement) {
            $data[] = $domElement->textContent;
        }
        return $data;

    }


}
