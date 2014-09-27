<?php

namespace Auryn;

class ReflectionCacheApc implements ReflectionCacheInterface
{
    private $localCache;
    private $timeToLive = 5;

    public function __construct(ReflectionCacheInterface $localCache = null)
    {
        $this->localCache = $localCache ?: new ReflectionCacheArray();
    }

    public function setTimeToLive($seconds)
    {
        $seconds = (int) $seconds;
        $this->timeToLive = ($seconds > 0) ? $seconds : $this->timeToLive;

        return $this;
    }

    private function fetch($key)
    {
        $localData = $this->localCache->fetch($key);

        if ($localData != FALSE) {
            return $localData;
        } else {
            return apc_exists($key) ? apc_fetch($key) : false;
        }
    }

    private function store($key, $data)
    {
        $this->localCache->store($key, $data);
        apc_store($key, $data, $this->timeToLive);
    }
}
