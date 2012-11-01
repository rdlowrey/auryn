<?php

namespace Auryn;

use RuntimeException;

/**
 * Adds APC caching/retrieval for reflection instances.
 * 
 * Benchmarks show APC caching results ~15-20% speed improvement over the standard reflection
 * pool implementation in very high-traffic web environments. As always, you should perform
 * your own benchmarks to determine if the APC version makes sense for your application.
 */
class ApcReflectionPool extends ReflectionPool implements CachingReflectionStorage {
    
    /**
     * @var int
     */
    private $timeToLive = 120;
    
    /**
     * Set the cache TTL -- the time in seconds until a cache entry becomes stale (120 by default)
     * 
     * @param seconds
     * @return void
     */
    public function setTimeToLive($seconds) {
        $this->timeToLive = (int) $seconds;
    }
    
    /**
     * Note that some cache values will be NULL, so array_key_exists MUST be used instead of isset.
     * 
     * @param string $key
     * @return mixed
     */
    protected function fetchFromCache($key) {
        return array_key_exists($key, $this->cache) ? $this->cache[$key] : $this->doApcFetch($key);
    }
    
    /**
     * @param string $key
     * @return mixed
     * @codeCoverageIgnore
     */
    protected function doApcFetch($key) {
        return apc_exists($key) ? apc_fetch($key) : false;
    }
    
    /**
     * @param string $key
     * @param mixed $data
     * @return void
     */
    protected function storeInCache($key, $data) {
        $this->cache[$key] = $data;
        $this->doApcStore($key, $data, $this->timeToLive);
    }
    
    /**
     * @param string $key
     * @param mixed $data
     * @param int $ttl
     * @return void
     * @codeCoverageIgnore
     */
    protected function doApcStore($key, $data, $ttl) {
        apc_store($key, $data, $ttl);
    }
}
