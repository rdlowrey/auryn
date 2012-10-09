<?php

namespace Auryn;

interface CachingReflectionStorage extends ReflectionStorage {
    
    /**
     * Set the cache TTL -- the time in seconds until a cache entry becomes stale
     * 
     * @param int $seconds
     */
    function setTimeToLive($seconds);
}
