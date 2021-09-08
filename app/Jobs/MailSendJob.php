<?php

namespace App\Jobs;

use App\Mail\MailParsedList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $parseClient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $parseClient)
    {
        $this->parseClient = $parseClient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('85d380f3e7-c07c6a@inbox.mailtrap.io')->send(new MailParsedList($this->parseClient));
    }
}
