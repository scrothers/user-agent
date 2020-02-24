<?php

namespace Crothers\UserAgent;

use Crothers\UserAgent\Cache\CacheInterface;
use Crothers\UserAgent\Cache\PSR16Cache;
use Crothers\UserAgent\Cache\PSR6Cache;
use Crothers\UserAgent\Log\LogInterface;
use Crothers\UserAgent\Log\PSR3Logger;
use Psr\Cache\CacheItemPoolInterface as PSRCacheItemPoolInterface;
use Psr\Container\ContainerInterface as PSRContainerInterface;
use Psr\Log\LoggerInterface as PSRLoggerInterface;
use Psr\SimpleCache\CacheInterface as PSRCacheInterface;

class Detector
{
    /**
     * The cache interface for the library.
     *
     * @var CacheInterface
     */
    private $cache;

    /**
     * The container interface if it is provided.
     *
     * @var PSRContainerInterface|null
     */
    private $container;

    /**
     * The logging interface for the library.
     *
     * @var LogInterface
     */
    private $logger;

    /**
     * Detector constructor.
     *
     * @param PSRContainerInterface|null $container
     */
    public function __construct(?PSRContainerInterface $container = null)
    {
        // If we got a container, go ahead and try and load the cache and logger.
        if (!is_null($container) and $container instanceof PSRContainerInterface) {
            $this->container = $container;

            // If the container has a PSR-3 logger, let's consume that.
            if ($this->container->has(PSRLoggerInterface::class)) {
                $this->logger = new PSR3Logger($this->container->get(PSRLoggerInterface::class));
            }

            // If the container has a PSR-6 cache pool, let's consume that.
            if ($this->container->has(PSRCacheItemPoolInterface::class)) {
                $this->cache = new PSR6Cache($this->container->get(PSRCacheItemPoolInterface::class));
            } elseif ($this->container->has(CacheInterface::class)) {
                $this->cache = new PSR16Cache($this->container->get(PSRCacheInterface::class));
            }
        }
    }
}
