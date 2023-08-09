<?php

namespace SnappMarket\GuzzleLogger;

class GuzzleLogger
{
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function handleRequestStats($service_name, $stats) {
        $url = $stats->getHandlerStats()["url"];
        $request_duration = $stats->getTransferTime() * 1000; //ms
        $status_code = 408;
        if ($stats->hasResponse()) {
            $status_code = $stats->getResponse()->getStatusCode();
            $response = $stats->getResponse()->getBody();
        } else {
            $response = $stats->getHandlerErrorData();
        }
        $this->logRecord($service_name, $status_code, $response, $request_duration, $url);
    }

    public function logRecord(string $serviceName, $status_code, $response, $request_duration, $url): void
    {
        $this->logger->info(
            'Third party logger log for: ' . $serviceName . ' service',
            [
                "response_status_code" => $status_code,
                "request_duration" => $request_duration, //ms
                "response_body" => $response,
                "url" => $url,
            ]
        );
    }
}
