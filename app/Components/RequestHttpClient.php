<?php


namespace App\Components;

use Illuminate\Support\Facades\Http;

class RequestHttpClient
{
    public final function getInstance(): string
    {
        $response = Http::get(config('app.feeds_url'));
        return $response->body();
    }
}
