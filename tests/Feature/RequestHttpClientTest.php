<?php

namespace Tests\Feature;

use App\Components\RequestHttpClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;


class RequestHttpClientTest extends TestCase
{
    public function test_checksSendingRequests()
    {
        $xml = "<title>ЦИК РБ рассказал о готовности к выборам в Башкирии </title>\r\n
                <link>https://www.bashinform.ru/news/1644382-na-vyborakh-v-bashkirii/</link>\r\n";

        Http::fake(function () use ($xml){
            return Http::response($xml);
        });

        $client = new RequestHttpClient();
        $result = $client->getInstance();

        $this->assertSame($xml,$result);

        Http::assertSent(function (\Illuminate\Http\Client\Request $request){
           return $request->url() === config('app.feeds_url');
        });
    }
}
