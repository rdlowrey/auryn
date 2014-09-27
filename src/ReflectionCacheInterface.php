<?php

namespace Auryn;

interface ReflectionCacheInterface
{
    public function fetch($key);
    public function store($key, $data);
}
