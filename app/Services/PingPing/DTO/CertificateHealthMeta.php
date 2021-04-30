<?php

declare(strict_types=1);

namespace App\Services\PingPing\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class CertificateHealthMeta extends DataTransferObject
{
    public string $issuer;
    public string $signatureAlgorithm;
    public bool $selfSigned;
    public null|Carbon $validFrom;
    public null|Carbon $validTo;
}
