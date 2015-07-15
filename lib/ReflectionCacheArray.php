<?php

namespace Auryn;

class ReflectionCacheArray implements ReflectionCache
{
    private $cache = array();

    public function fetch($key)
    {
        // The additional isset() check here improves performance but we also
        // need array_key_exists() because some cached values === NULL.
        return (isset($this->cache[$key]) || array_key_exists($key, $this->cache))
            ? $this->cache[$key]
            : false;
    }

    public function store($key, $data)
    {
        $this->cache[$key] = $data;
    }
}
