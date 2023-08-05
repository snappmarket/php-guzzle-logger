<?php

namespace ExternalRequests\Trcak;


use GuzzleHttp\TransferStats;

class SymfonyLogger implements BaseLoggerInterface  {
    private $logger;

    public function __construct($logger) {
        $this->logger = $logger;
    }
    public function logRecord(string $serviceName,TransferStats $stats): void
    {
        $status_code = 408;
        if ($stats->hasResponse()) {
            $status_code = $stats->getResponse()->getStatusCode();
            $response = $stats->getResponse()->getBody();
        } else {
            $response = $stats->getHandlerErrorData();
        }
        $this->logger->log(
            'Third party logger log for: ' . $serviceName . ' service',
            'ERROR',
            [
                //check has response
                "response_status_code" => $status_code,
                "request_duration" => $stats->getTransferTime() * 1000, //ms
                "response_body" => $response,
                "url" => $stats->getHandlerStats()["url"],
            ]
        );
    }
}


