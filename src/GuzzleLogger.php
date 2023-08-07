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

    public function handleRequestStats(string $serviceName, $stats)
    {
        $status_code = 408;
        if ($stats->hasResponse()) {
            $status_code = $stats->getResponse()->getStatusCode();
            $response = $stats->getResponse()->getBody();
        } else {
            $response = $stats->getHandlerErrorData();
        }
        $url = $stats->getHandlerStats()["url"];
        $request_duration = $stats->getTransferTime() * 1000;
        $this->logger->logRecord($serviceName, $status_code, $request_duration, $response, $url);
    }
}