<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\PingPing\Client;
use Illuminate\Support\ServiceProvider;

class PingPingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client(
                uri: config('services.ping-ping.uri'),
                token: config('services.ping-ping.token'),
                timeout: config('services.ping-ping.timeout'),
                retryTimes: config('services.ping-ping.retry_times'),
                retryMilliseconds: config('services.ping-ping.retry_milliseconds'),
            );
        });
    }

    public function boot()
    {
        //
    }
}
