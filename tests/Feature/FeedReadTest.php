<?php

namespace Tests\Feature;

use App\Components\FeedRead;
use App\Components\RequestHttpClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedReadTest extends TestCase
{
    public function test_reader()
    {
        $xml ='<channel><item>\r\n
                <title>В учреждениях культуры Башкирии усилены ограничительные меры в связи с COVID-19</title>\r\n
                <link>https://www.bashinform.ru/news/1648622-ranichitelnye-mery-v-svyazi-s-covid-19/</link>\r\n
                </item>\r\n
                </channel>
                ';
        $mockClient = $this->createMock(RequestHttpClient::class);
        $mockClient->expects($this->exactly(1))->method('get_body')->willReturn($xml);
        $inst = new FeedRead($mockClient);
        /** @var ParsedNoticeDTO[] **/
        $reader = $inst->read();

        dd($reader);
    }

}
