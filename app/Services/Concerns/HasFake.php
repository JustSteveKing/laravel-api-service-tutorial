<?php

declare(strict_types=1);

namespace App\Services\Concerns;

use Illuminate\Support\Facades\Http;

trait HasFake
{
    /**
     * Proxies a fake call to Illuminate\Http\Client\Factory::fake()
     * 
     * @param null|callable|array $callback
     */
    public static function fake(
        null|callable|array $callback = null,
    ): void {
        Http::fake($callback);
    }
}
