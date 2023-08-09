<?php

namespace SnappMarket\GuzzleLogger;

class GuzzleLogger
{
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function handleRequestStats($serviceName, $stats) {
        $url = $stats->getHandlerStats()["url"];
        $requestDuration = $stats->getTransferTime() * 1000; //ms
        $statusCode = 408;
        if ($stats->hasResponse()) {
            $statusCode = $stats->getResponse()->getStatusCode();
            $response = $stats->getResponse()->getBody();
        } else {
            $response = $stats->getHandlerErrorData();
        }
        $this->logRecord($serviceName, $statusCode, $response, $requestDuration, $url);
    }

    public function logRecord(string $serviceName, $statusCode, $response, $requestDuration, $url): void
    {
        $this->logger->info(
            'Third party logger log for: ' . $serviceName . ' service',
            [
                "response_status_code" => $statusCode,
                "request_duration" => $requestDuration, //ms
                "response_body" => $response,
                "url" => $url,
            ]
        );
    }
}
