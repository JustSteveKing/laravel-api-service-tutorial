<?php

declare(strict_types=1);

namespace App\Services\PingPing\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Monitor extends DataTransferObject
{
    public int $id;
    public string $identifier;
    public string $alias;
    public string $scheme;
    public string $host;
    public string $port;
    public string $url;
    public string $statusPage;
    public Checks $checks;
}
