<?php

namespace ExternalRequests\Trcak;

class Wrapper
{
    public function wichLogger(string $loggerType, $logger)
    {
        switch ($loggerType) {
            case "symfony":
                return new SymfonyLogger($logger);
            case "laravel":
                return new LaravelLogger($logger);
        }

    }
}