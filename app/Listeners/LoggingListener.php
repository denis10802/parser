<?php

namespace App\Listeners;

use App\Events\EventParseProcessing;
use App\Jobs\LoggingProcessJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LoggingListener
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
        LoggingProcessJob::dispatch($contents);
    }
}
