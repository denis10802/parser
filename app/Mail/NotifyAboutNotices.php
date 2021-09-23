<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyAboutNotices extends Mailable
{
    use Queueable, SerializesModels;

    protected array $titles;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $titles)
    {
        $this->titles = $titles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('admin.mail')->with([
            'titles'=>$this->titles
        ]);
    }
}
