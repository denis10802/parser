<?php

namespace Tests\Feature;

use App\Components\FeedReadComponent;
use App\Components\NoticeRefreshComponent;
use App\Components\ParseNoticeDTO;
use App\Events\NoticesParsed;
use App\Http\Controllers\RefreshNoticesCommand;
use App\Jobs\Logging;
use App\Jobs\MailSend;
use App\Listeners\LoggingNotices;
use App\Listeners\SendingToMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class EventNoticesTest extends TestCase
{
    private object $mock;

    public function setUp(): void
    {
        parent::setUp();
        $arrayToEntry =
            [
            new ParseNoticeDTO('Радий Хабиров параолимпийцам','https://www.bashinform.ru/news/1645589-vsekh/'),
            new ParseNoticeDTO('ВТБ и ДОМ.РФ запускают первую','https://www.bashinform.ru/news/1645581-ipoteku/')
        ];

        $this->mock = $this->createMock(FeedReadComponent::class);
        $this->mock->expects($this->exactly(1))->method('read')->willReturn($arrayToEntry);
    }

    public function test_intercept_event()
    {
        // Arrange
        Event::fake(
            NoticesParsed::class
        );
        $refresh = new NoticeRefreshComponent();

        // Act
        $instance = new RefreshNoticesCommand();
        $instance($this->mock, $refresh);

        // Assert
        Event::assertDispatched(NoticesParsed::class);
    }

    public function test_checking_if_listeners()
    {
        // Arrange
        Event::fake(
            NoticesParsed::class
        );
        $refresh = new NoticeRefreshComponent();

        // Act
        $instance = new RefreshNoticesCommand();
        $instance($this->mock, $refresh);

        // Assert
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
        // Arrange
        Queue::fake();
        $refresh = new NoticeRefreshComponent();

        // Act
        $instance = new RefreshNoticesCommand();
        $instance($this->mock, $refresh);

        // Assert
        Event::fake(
            NoticesParsed::class
        );
        Queue::assertPushed(Logging::class);
        Queue::assertPushed(MailSend::class);
    }
}
