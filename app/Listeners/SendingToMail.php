<?php

namespace App\Listeners;

use App\Events\NoticesParsed;
use App\Jobs\Logging;
use App\Jobs\MailSend;
use App\Mail\NotifyAboutNotices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendingToMail
{
    /**
     * Handle the event.
     *
     * @param  NoticesParsed  $event
     * @return void
     */
    public function handle(NoticesParsed $event)
    {
        $notices = $event->notices;
        $headlines = [];
        foreach ($notices as $notice){
            $headlines[] = $notice['title'];
        }
        MailSend::dispatch($headlines);
    }
}
