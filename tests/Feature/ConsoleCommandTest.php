<?php

namespace Tests\Feature;

use App\Components\FeedContentParser;
use App\Components\RequestHttpClient;
use Tests\TestCase;


class ConsoleCommandTest extends TestCase
{
    public function test_console_command()
    {
        $request = new RequestHttpClient();
        $parseData = new FeedContentParser($request);
        $contents = $parseData->getNotices();

        $this->artisan('gettable:feednotice')->expectsTable(
            ['Title','Link'],
            $contents
        );
    }
}
