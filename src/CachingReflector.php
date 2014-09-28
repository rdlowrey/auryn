<?php

namespace Auryn;

class CachingReflector implements ReflectorInterface
{
    const CACHE_KEY_CLASSES = 'auryn.refls.classes.';
    const CACHE_KEY_CTORS = 'auryn.refls.ctors.';
    const CACHE_KEY_CTOR_PARAMS = 'auryn.refls.ctor-params.';
    const CACHE_KEY_FUNCS = 'auryn.refls.funcs.';
    const CACHE_KEY_METHODS = 'auryn.refls.methods.';

    private $reflector;
    private $cache;

    public function __construct(ReflectorInterface $reflector = null, ReflectionCacheInterface $cache = null)
    {
        $this->reflector = $reflector ?: new StandardReflector();
        $this->cache = $cache ?: new ReflectionCacheArray();
    }

    public function getClass($className)
    {
        $cacheKey = self::CACHE_KEY_CLASSES.strtolower($className);

        if (!$reflectionClass = $this->cache->fetch($cacheKey)) {
            $reflectionClass = new \ReflectionClass($className);
            $this->cache->store($cacheKey, $reflectionClass);
        }

        return $reflectionClass;
    }

    public function getCtor($className)
    {
        $cacheKey = self::CACHE_KEY_CTORS.strtolower($className);

        $reflectedCtor = $this->cache->fetch($cacheKey);

        if ($reflectedCtor === FALSE) {
            $reflectionClass = $this->getClass($className);
            $reflectedCtor = $reflectionClass->getConstructor();
            $this->cache->store($cacheKey, $reflectedCtor);
        }

        return $reflectedCtor;
    }

    public function getCtorParams($className)
    {
        $cacheKey = self::CACHE_KEY_CTOR_PARAMS.strtolower($className);

        $reflectedCtorParams = $this->cache->fetch($cacheKey);

        if (FALSE !== $reflectedCtorParams) {
            return $reflectedCtorParams;
        } elseif ($reflectedCtor = $this->getCtor($className)) {
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
            $paramCacheKey = self::CACHE_KEY_CLASSES."{$lowClass}.{$lowMethod}.param-{$lowParam}";
        } else {
            $lowFunc = strtolower($function->name);
            $paramCacheKey = ($lowFunc !== '{closure}')
                ? self::CACHE_KEY_FUNCS.".{$lowFunc}.param-{$lowParam}"
                : null;
        }

        $typeHint = ($paramCacheKey === NULL) ? false : $this->cache->fetch($paramCacheKey);

        if (FALSE !== $typeHint) {
            return $typeHint;
        }

        if ($reflectionClass = $param->getClass()) {
            $typeHint = $reflectionClass->getName();
            $classCacheKey = self::CACHE_KEY_CLASSES.strtolower($typeHint);
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
        $cacheKey = self::CACHE_KEY_FUNCS.$lowFunc;

        $reflectedFunc = $this->cache->fetch($cacheKey);

        if (FALSE === $reflectedFunc) {
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

        $cacheKey = self::CACHE_KEY_METHODS.strtolower($className).'.'.strtolower($methodName);

        if (!$reflectedMethod = $this->cache->fetch($cacheKey)) {
            $reflectedMethod = new \ReflectionMethod($className, $methodName);
            $this->cache->store($cacheKey, $reflectedMethod);
        }

        return $reflectedMethod;
    }
}
