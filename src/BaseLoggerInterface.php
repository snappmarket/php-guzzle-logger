<?php
namespace ExternalRequests\Trcak;

use GuzzleHttp\TransferStats;

interface BaseLoggerInterface {
    public function logRecord(string $serviceName,TransferStats $stats);
}