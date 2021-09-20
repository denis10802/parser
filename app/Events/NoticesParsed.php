<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoticesParsed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $notices;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $notices)
    {
        $this->notices = $notices;
    }
}
