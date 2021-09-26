<?php

namespace Tests\Feature;

use App\Components\ParseNoticeDTO;
use App\Jobs\Logging;
use App\Jobs\MailSend;
use App\Mail\NotifyAboutNotices;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class JobsTest extends TestCase
{
    private array  $notices;

    public function setUp(): void
    {
        parent::setUp();
        $this->notices = [
            new ParseNoticeDTO('Радий Хабиров параолимпийцам','https://www.bashinform.ru/news/1645589-vsekh/'),
            new ParseNoticeDTO('ВТБ и ДОМ.РФ запускают первую','https://www.bashinform.ru/news/1645581-ipoteku/')
        ];
    }

    public function test_job_logging()
    {
        $this->markTestSkipped('TODO: fix test');
        Queue::fake();

        $order = new Logging();
        $order->handle();
    }

    public function test_mail_send()
    {
        // Arrange
        Mail::fake();
        $titles = array_column($this->notices,'title');

        // Act
        $order = new MailSend($titles);
        $order->handle();

        // Assert
        Mail::assertSent(NotifyAboutNotices::class);
        Mail::assertSent(function (NotifyAboutNotices $mail) use ($titles) {
            return $mail->build()->viewData['titles'] === $titles;
        });
    }
}
