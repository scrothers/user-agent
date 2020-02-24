<?php

namespace Crothers\UserAgent\Cache;

use Psr\Cache\CacheItemPoolInterface;

class PSR6Cache implements CacheInterface
{
    /**
     * The cache object being used.
     *
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * PSR16Cache constructor.
     *
     * @param CacheItemPoolInterface $cacheItemPool
     */
    public function __construct(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cache = $cacheItemPool;
    }
}
