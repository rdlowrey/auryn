<?php

namespace Auryn;

class CachingReflector implements Reflector
{
    const CACHE_KEY_CLASSES = 'auryn.refls.classes.';
    const CACHE_KEY_CTORS = 'auryn.refls.ctors.';
    const CACHE_KEY_CTOR_PARAMS = 'auryn.refls.ctor-params.';
    const CACHE_KEY_FUNCS = 'auryn.refls.funcs.';
    const CACHE_KEY_METHODS = 'auryn.refls.methods.';

    private $reflector;
    private $cache;

    public function __construct(Reflector $reflector = null, ReflectionCache $cache = null)
    {
        $this->reflector = $reflector ?: new StandardReflector;
        $this->cache = $cache ?: new ReflectionCacheArray;
    }

    public function getClass($class)
    {
        $cacheKey = self::CACHE_KEY_CLASSES . strtolower($class);

        if (!$reflectionClass = $this->cache->fetch($cacheKey)) {
            $reflectionClass = new \ReflectionClass($class);
            $this->cache->store($cacheKey, $reflectionClass);
        }

        return $reflectionClass;
    }

    public function getCtor($class)
    {
        $cacheKey = self::CACHE_KEY_CTORS . strtolower($class);

        $reflectedCtor = $this->cache->fetch($cacheKey);

        if ($reflectedCtor === false) {
            $reflectionClass = $this->getClass($class);
            $reflectedCtor = $reflectionClass->getConstructor();
            $this->cache->store($cacheKey, $reflectedCtor);
        }

        return $reflectedCtor;
    }

    public function getCtorParams($class)
    {
        $cacheKey = self::CACHE_KEY_CTOR_PARAMS . strtolower($class);

        $reflectedCtorParams = $this->cache->fetch($cacheKey);

        if (false !== $reflectedCtorParams) {
            return $reflectedCtorParams;
        } elseif ($reflectedCtor = $this->getCtor($class)) {
            $reflectedCtorParams = $reflectedCtor->getParameters();
        } else {
            $reflectedCtorParams = null;
        }

        $this->cache->store($cacheKey, $reflectedCtorParams);

        return $reflectedCtorParams;
    }

    public function getParamTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param)
    {
        $lowParam = strtolower($param->name);

        if ($function instanceof \ReflectionMethod) {
            $lowClass = strtolower($function->class);
            $lowMethod = strtolower($function->name);
            $paramCacheKey = self::CACHE_KEY_CLASSES . "{$lowClass}.{$lowMethod}.param-{$lowParam}";
        } else {
            $lowFunc = strtolower($function->name);
            $paramCacheKey = (strpos($lowFunc, '{closure}') === false)
                ? self::CACHE_KEY_FUNCS . ".{$lowFunc}.param-{$lowParam}"
                : null;
        }

        $typeHint = ($paramCacheKey === null) ? false : $this->cache->fetch($paramCacheKey);

        if (false !== $typeHint) {
            return $typeHint;
        }

        if ($reflectionClass = $param->getClass()) {
            $typeHint = $reflectionClass->getName();
            $classCacheKey = self::CACHE_KEY_CLASSES . strtolower($typeHint);
            $this->cache->store($classCacheKey, $reflectionClass);
        } else {
            $typeHint = null;
        }

        $this->cache->store($paramCacheKey, $typeHint);

        return $typeHint;
    }

    public function getFunction($functionName)
    {
        $lowFunc = strtolower($functionName);
        $cacheKey = self::CACHE_KEY_FUNCS . $lowFunc;

        $reflectedFunc = $this->cache->fetch($cacheKey);

        if (false === $reflectedFunc) {
            $reflectedFunc = new \ReflectionFunction($functionName);
            $this->cache->store($cacheKey, $reflectedFunc);
        }

        return $reflectedFunc;
    }

    public function getMethod($classNameOrInstance, $methodName)
    {
        $className = is_string($classNameOrInstance)
            ? $classNameOrInstance
            : get_class($classNameOrInstance);

        $cacheKey = self::CACHE_KEY_METHODS . strtolower($className) . '.' . strtolower($methodName);

        if (!$reflectedMethod = $this->cache->fetch($cacheKey)) {
            $reflectedMethod = new \ReflectionMethod($className, $methodName);
            $this->cache->store($cacheKey, $reflectedMethod);
        }

        return $reflectedMethod;
    }
}
