<?php


namespace App\Components;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Message;

class ImportDataClient
{

    public  Client $client;


    public function __construct()
    {
        try {
            $this->client = new Client([
                'base_uri' => 'https://feeds.feedburner.com/',
                'timeout'  => 2.0,
                'verify'=>false,
            ]);
        }catch (TransferException $exception){
            echo Message::toString($exception->getMessage());
        }
    }


    public function importData()
    {
        $import =  new ImportDataClient();
        $import = $import->client->get('bashinform/all');
        return $content = $import->getBody()->getContents();
    }


}
