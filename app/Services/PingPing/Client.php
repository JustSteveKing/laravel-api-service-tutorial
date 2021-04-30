<?php

declare(strict_types=1);

namespace App\Services\PingPing;

use App\Services\Concerns\HasFake;
use Illuminate\Support\Facades\Http;
use App\Services\PingPing\Actions\CreateMonitor;
use App\Services\PingPing\Collections\MonitorCollection;

class Client
{
    use HasFake;

    public function __construct(
        protected string $uri,
        protected string $token,
        protected int $timeout = 10,
        protected null|int $retryTimes = null,
        protected null|int $retryMilliseconds = null,
    ) {}

    public function monitors()
    {
        $request = Http::withToken(
            token: $this->token,
        )->withHeaders([
            'Accept' => 'application/json',
        ])->timeout(
            seconds: $this->timeout,
        );

        if (
            ! is_null($this->retryTimes)
            && ! is_null($this->retryMilliseconds)
        ) {
            $request->retry(
                times: $this->retryTimes,
                sleep: $this->retryMilliseconds,
            );
        }

        $response = $request->get(
            url: "{$this->uri}/monitors",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        $collection = new MonitorCollection();

        foreach ($response->collect('data') as $item) {
            $monitor = CreateMonitor::handle(
                item: $item,
            );

            $collection->add(
                item: $monitor,
            );
        }

        return $collection;
    }
}
