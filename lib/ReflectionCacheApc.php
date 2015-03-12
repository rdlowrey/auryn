<?php

namespace Auryn;

class ReflectionCacheApc implements ReflectionCache {
    private $localCache;
    private $timeToLive = 5;

    public function __construct(ReflectionCache $localCache = NULL) {
        $this->localCache = $localCache ?: new ReflectionCacheArray;
    }

    public function setTimeToLive($seconds) {
        $seconds = (int) $seconds;
        $this->timeToLive = ($seconds > 0) ? $seconds : $this->timeToLive;

        return $this;
    }

    public function fetch($key) {
        $localData = $this->localCache->fetch($key);

        if ($localData != FALSE) {
            return $localData;
        } else {
            $success = null; // stupid by-ref parameter that scrutinizer complains about
            $data = apc_fetch($key, $success);
            return $success ? $data : FALSE;
        }
    }

    public function store($key, $data) {
        $this->localCache->store($key, $data);
        apc_store($key, $data, $this->timeToLive);
    }
}
