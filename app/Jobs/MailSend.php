<?php

namespace App\Jobs;

use App\Mail\NotifyAboutNotices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $headlines;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $headlines)
    {
        $this->headlines = $headlines;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(config('mail.from.address'))->send(new NotifyAboutNotices($this->headlines));
    }
}
