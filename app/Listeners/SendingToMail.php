<?php

namespace App\Listeners;

use App\Events\NoticesParsed;
use App\Jobs\MailSend;

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
