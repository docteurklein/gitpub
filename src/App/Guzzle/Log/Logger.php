<?php

namespace App\Guzzle\Log;

use Psr\Log\LoggerInterface;

class Logger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke($log)
    {
        $this->logger->debug($log);
    }
}
