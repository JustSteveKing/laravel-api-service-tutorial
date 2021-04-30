<?php

declare(strict_types=1);

namespace App\Services\PingPing\Actions;

use Carbon\Carbon;
use App\Services\PingPing\DTO\Checks;
use App\Services\PingPing\DTO\Uptime;
use App\Services\PingPing\DTO\Monitor;
use App\Services\PingPing\DTO\UptimeMeta;
use App\Services\PingPing\DTO\CertificateHealth;
use App\Services\PingPing\DTO\CertificateHealthMeta;

class CreateMonitor
{
    public static function handle(array $item): Monitor
    {
        return new Monitor(
            id: $item['id'],
            identifier: $item['identifier'],
            alias: $item['alias'],
            scheme: $item['scheme'],
            host: $item['host'],
            port: $item['port'],
            url: $item['url'],
            statusPage: $item['status_page'],
            checks: new Checks(
                uptime: new Uptime(
                    id: $item['checks']['uptime']['id'],
                    status: $item['checks']['uptime']['status'],
                    error: $item['checks']['uptime']['error'],
                    interval: $item['checks']['uptime']['interval'],
                    enabled: $item['checks']['uptime']['is_enabled'],
                    notificationThreshold: $item['checks']['uptime']['notification_threshold'],
                    lastCheckAt: Carbon::parse($item['checks']['uptime']['last_check_at']),
                    meta: new UptimeMeta(
                        httpStatusCode: $item['checks']['uptime']['meta']['http_status_code'],
                        averageUptimePercentage: $item['checks']['uptime']['meta']['average_uptime_percentage'],
                        averageResponseTime: $item['checks']['uptime']['meta']['average_response_time'],
                        offlineSince: Carbon::parse($item['checks']['uptime']['meta']['offline_since']),
                    ),
                ),
                certificateHealth: new CertificateHealth(
                    id: $item['checks']['certificate_health']['id'],
                    status: $item['checks']['certificate_health']['status'],
                    error: $item['checks']['certificate_health']['error'],
                    interval: $item['checks']['certificate_health']['interval'],
                    enabled: $item['checks']['certificate_health']['is_enabled'],
                    notificationThreshold: $item['checks']['certificate_health']['notification_threshold'],
                    lastCheckAt: Carbon::parse($item['checks']['certificate_health']['last_check_at']),
                    meta: new CertificateHealthMeta(
                        issuer: $item['checks']['certificate_health']['meta']['issuer'],
                        signatureAlgorithm: $item['checks']['certificate_health']['meta']['signature_algorithm'],
                        selfSigned: $item['checks']['certificate_health']['meta']['is_self_signed'],
                        validFrom: Carbon::parse($item['checks']['certificate_health']['meta']['valid_from']),
                        validTo: Carbon::parse($item['checks']['certificate_health']['meta']['valid_to']),
                    ),
                ),
            ),
        );
    }
}
