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
    public function test_checks_sending_requests()
    {
        // Arrange
        $xml = "<channel>
                <item><title>В учреждениях культуры Башкирии </title>
                <link>https://www.rietdbk.plde0fo</link></item>
                </channel>";
        Http::fake(function () use ($xml){
            return Http::response($xml);
        });

        // Act
        $instance = new FeedReadComponent();
        $response = $instance->read();

        // Assert
        $this->assertObjectHasAttribute('title', $response[0]);
        $this->assertSame($response[0]->title,'В учреждениях культуры Башкирии');
        Http::assertSent(function (Request $request){
         return $request->url() === config('app.feeds_url');
        });
    }
}
