<?php

namespace Tests\Feature;

use App\Components\FeedReadComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;


class FeedReadTest extends TestCase
{
    public function test_checksSendingRequests()
    {
        //arrange
        $xml = "<channel>
                <item><title>В учреждениях культуры Башкирии </title>
                <link>https://www.rietdbk.plde0fo</link></item>
                </channel>";
        Http::fake(function () use ($xml){
            return Http::response($xml);
        });
        //act
        $instance = new FeedReadComponent();
        $response = $instance->read();
        //assert
        $this->assertObjectHasAttribute('title', $response[0]);
        $this->assertSame($response[0]->title,'В учреждениях культуры Башкирии');
        Http::assertSent(function (Request $request){
         return $request->url() === config('app.feeds_url');
        });
    }
}
