<?php

namespace App\Providers;

use App\Components\Services\FeedReadBashinform;
use App\Components\Services\FeedReedHabr;
use App\Contracts\IFeedRead;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IFeedRead::class, function ($app) {
            return new FeedReadBashinform();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
