<?php

declare(strict_types=1);

namespace App\Services\PingPing\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Checks extends DataTransferObject
{
    public Uptime $uptime;
    public CertificateHealth $certificateHealth;
}
