<?php

namespace App\Providers;

use App\Events\EventParseProcessing;
use App\Listeners\LoggingListener;
use App\Listeners\MailTrapListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
       EventParseProcessing::class => [
            LoggingListener::class,
            MailTrapListener::class
        ],
    ];


    /**
     * Register any events for your application.php artisan make:listener SendPodcastNotification --event=PodcastProcessed
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
