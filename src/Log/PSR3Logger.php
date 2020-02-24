<?php

namespace Crothers\UserAgent\Log;

use Psr\Log\LoggerInterface;

class PSR3Logger implements LogInterface
{
    /**
     * The logging instance being used.
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PSR3Logger constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
