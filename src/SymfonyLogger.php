<?php

namespace SnappMarket\PhpGuzzleLogger;


class SymfonyLogger implements BaseLoggerInterface
{
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function logRecord($serviceName, $status_code, $request_duration, $response, $url): void
    {
        $this->logger->log(
            'Third party logger log for: ' . $serviceName . ' service',
            'ERROR',
            [
                "response_status_code" => $status_code,
                "request_duration" => $request_duration,
                "response_body" => $response,
                "url" => $url,
            ]
        );
    }
}


