<?php

namespace SnappMarket\PhpGuzzleLogger;

class GuzzleLogger
{
    private $logger;

    public function __construct($loggerType, $logger)
    {
        $wrapper = new Wrapper();
        $this->logger = $wrapper->wichLogger($loggerType, $logger);
    }

    public function logRecord($serviceName, $stats)
    {
        $this->logger->logRecord($serviceName, $stats);
    }

}