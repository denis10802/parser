<?php


namespace App\Components;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ImportDataClient
{

    public Response $client;

    public function __construct()
    {
      $this->client = Http::get(config('app.client_uri'));
    }



    public function importData(): string
    {
        $import =  new ImportDataClient();
        return $import->client->body();
    }


}
