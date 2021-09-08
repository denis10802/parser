<?php

namespace App\Listeners;

use App\Events\EventParseProcessing;
use App\Jobs\LoggingProcessJob;
use App\Jobs\MailSendJob;
use App\Mail\MailParsedList;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailTrapListener
{
    /**
     * Handle the event.
     *
     * @param  EventParseProcessing  $event
     * @return void
     */
    public function handle(EventParseProcessing $event)
    {

        $data = $event->parseClientData;
        $contents = [];
        foreach ($data as $item){
            $contents[] = $item['title'];
        }
        MailSendJob::dispatch($contents);


    }
}
