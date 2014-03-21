<?php

namespace Auryn;

/**
 * Adds APC caching/retrieval for reflection instances.
 *
 * Benchmarks show APC caching results ~15-20% speed improvement over the standard reflection
 * pool implementation in very high-traffic web environments. As always, you should perform
 * your own benchmarks to determine if the APC version makes sense for your application.
 */
class ApcReflectionPool extends ReflectionPool {

    /**
     * @var int
     */
    private $timeToLive = 15;

    /**
     * Set the cache TTL -- the time in seconds until a cache entry becomes stale (15 by default)
     *
     * @param int $seconds How long to cache reflection instances
     * @return ApcReflectionPool Returns the current object instance
     */
    public function setTimeToLive($seconds) {
        $seconds = (int) $seconds;
        $this->timeToLive = ($seconds > 0) ? $seconds : $this->timeToLive;

        return $this;
    }

    protected function fetchFromCache($key) {
        return array_key_exists($key, $this->cache) ? $this->cache[$key] : $this->doApcFetch($key);
    }

    protected function doApcFetch($key) {
        return apc_exists($key) ? apc_fetch($key) : FALSE;
    }

    protected function storeInCache($key, $data) {
        $this->cache[$key] = $data;
        $this->doApcStore($key, $data, $this->timeToLive);
    }

    protected function doApcStore($key, $data, $ttl) {
        apc_store($key, $data, $ttl);
    }

}
