<?php

namespace SnappMarket\PhpGuzzleLogger;


interface BaseLoggerInterface
{
    public function logRecord(string $serviceName, TransferStats $stats);
}