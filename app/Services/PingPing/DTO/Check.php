<?php

declare(strict_types=1);

namespace App\Services\PingPing\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Check extends DataTransferObject
{
    public int $id;
    public string $status;
    public null|string $error;
    public int $interval;
    public bool $enabled;
    public int $notificationThreshold;
    public Carbon $lastCheckAt;
}
