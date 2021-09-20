<?php

namespace Tests\Feature;

use App\Components\FeedContentParser;
use App\Components\NoticeModelUpdate;
use App\Events\NoticesParsed;
use App\Jobs\Logging;
use App\Jobs\MailSend;
use App\Listeners\LoggingNotices;
use App\Listeners\SendingToMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EventNoticesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $arrayToEntry = [
            [
                "title" => "Радий Хабиров параолимпийцам",
                "link" => "https://www.bashinform.ru/news/1645589-vsekh/"
            ],
            [
                "title" => "ВТБ и ДОМ.РФ запускают первую",
                "link" => "https://www.bashinform.ru/news/1645581-ipoteku/"
            ]
        ];

        $instance = new NoticeModelUpdate();
        $mock = $this->createMock(FeedContentParser::class);
        $mock->expects($this->exactly(1))->method('getNotices')->willReturn($arrayToEntry);
        $instance($mock);
    }

    public function test_intercept_event()
    {
        Event::fake(
            NoticesParsed::class
        );
        $this->setUp();
        Event::assertDispatched(NoticesParsed::class);
    }

    public function test_checking_if_listeners()
    {
        $this->setUp();
        Event::fake(
            NoticesParsed::class
        );

        Event::assertListening(
            NoticesParsed::class,
            LoggingNotices::class
        );
        Event::assertListening(
            NoticesParsed::class,
            SendingToMail::class
        );
    }

    public function test_sending_job_queue()
    {
        Queue::fake();
        $this->setUp();
        Event::fake(
            NoticesParsed::class
        );
        Queue::assertPushed(Logging::class);
        Queue::assertPushed(MailSend::class);
    }
}