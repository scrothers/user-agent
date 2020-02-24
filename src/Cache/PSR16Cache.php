<?php

namespace Crothers\UserAgent\Cache;


class PSR16Cache implements CacheInterface
{
    /**
     * The cache object being used.
     *
     * @var CacheInterface
     */
    private $cache;

    /**
     * PSR16Cache constructor.
     *
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }
}
