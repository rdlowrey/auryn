<?php

namespace Auryn;

use ReflectionClass,
    ReflectionMethod,
    ReflectionParameter;

/**
 * A caching and retrieval layer for reflected classes, constructors and parameters
 *
 * Reflection is a bit more expensive than most code, so we implement a facade to cache the
 * reflections as they're generated. This minimizes the performance impact of widespread
 * reflection usage across applications.
 */
class ReflectionPool implements ReflectionStorage {
    const CACHE_KEY_CLASSES = 'auryn.refls.classes';
    const CACHE_KEY_CTORS = 'auryn.refls.ctors';
    const CACHE_KEY_CTOR_PARAMS = 'auryn.refls.ctor-params';
    const CACHE_KEY_FUNCS = 'auryn.refls.funcs';
    const CACHE_KEY_METHODS = 'auryn.refls.methods';

    /**
     * @var array
     */
    protected $cache = array();

    /**
     * Retrieves ReflectionClass objects, caching them for future retrievals
     *
     * @param string $class The class we want to reflect
     * @throws \ReflectionException If the class can't be found or auto-loaded
     * @return \ReflectionClass
     */
    public function getClass($class) {
        $lowClass = strtolower($class);
        $cacheKey = self::CACHE_KEY_CLASSES . '.' . $lowClass;

        if (!$reflectionClass = $this->fetchFromCache($cacheKey)) {
            $reflectionClass = new ReflectionClass($class);
            $this->storeInCache($cacheKey, $reflectionClass);
        }

        return $reflectionClass;
    }

    protected function fetchFromCache($key) {
        return array_key_exists($key, $this->cache) ? $this->cache[$key] : FALSE;
    }

    protected function storeInCache($key, $data) {
        $this->cache[$key] = $data;
    }

    /**
     * Retrieves and caches the class's constructor ReflectionMethod
     *
     * @param string $class The class whose constructor we want to reflect
     * @return \ReflectionMethod Returns reflected constructor or NULL if class has no constructor.
     */
    public function getConstructor($class) {
        $lowClass = strtolower($class);
        $cacheKey = self::CACHE_KEY_CTORS . '.' . $lowClass;

        $reflectedCtor = $this->fetchFromCache($cacheKey);

        if (FALSE === $reflectedCtor) {
            $reflectionClass = $this->getClass($class);
            $reflectedCtor = $reflectionClass->getConstructor();
            $this->storeInCache($cacheKey, $reflectedCtor);
        }

        return $reflectedCtor;
    }

    /**
     * Retrieves and caches constructor parameters for the given class name
     *
     * @param string $class The class whose constructor parameters we're retrieving
     * @return array An array of ReflectionParameter objects or NULL if no constructor exists
     */
    public function getConstructorParameters($class) {
        $lowClass = strtolower($class);
        $cacheKey = self::CACHE_KEY_CTOR_PARAMS . '.' . $lowClass;

        $reflectedCtorParams = $this->fetchFromCache($cacheKey);

        if (FALSE !== $reflectedCtorParams) {
            return $reflectedCtorParams;
        } elseif ($reflectedCtor = $this->getConstructor($class)) {
            $reflectedCtorParams = $reflectedCtor->getParameters();
        } else {
            $reflectedCtorParams = NULL;
        }

        $this->storeInCache($cacheKey, $reflectedCtorParams);

        return $reflectedCtorParams;
    }

    /**
     * Retrieves the class type-hint from a given ReflectionParameter
     *
     * There is no way to retrieve the string type-hint value directly from a ReflectionParameter
     * instance -- a new ReflectionClass must be generated from the type-hint and its name returned.
     * We require the reflection function so that a unique cache key can be generated for
     * future type-hint retrieval.
     *
     * @param \ReflectionFunctionAbstract $function
     * @param \ReflectionParameter $param
     * @return string The type-hint of the specified parameter or NULL if none exists
     */
    public function getParamTypeHint(\ReflectionFunctionAbstract $function, \ReflectionParameter $param) {
        $lowParam = strtolower($param->name);

        if ($function instanceof \ReflectionMethod) {
            $lowClass = strtolower($function->class);
            $lowMethod = strtolower($function->name);
            $paramCacheKey = self::CACHE_KEY_CLASSES . "{$lowClass}.{$lowMethod}.param-{$lowParam}";
        } else {
            $lowFunc = strtolower($function->name);
            $paramCacheKey = ($lowFunc !== '{closure}')
                ? self::CACHE_KEY_FUNCS . ".{$lowFunc}.param-{$lowParam}"
                : NULL;
        }

        $typeHint = ($paramCacheKey === NULL) ? FALSE : $this->fetchFromCache($paramCacheKey);

        if (FALSE !== $typeHint) {
            return $typeHint;
        }

        if ($reflectionClass = $param->getClass()) {
            $typeHint = $reflectionClass->getName();
            $classCacheKey = self::CACHE_KEY_CLASSES . '.' . strtolower($typeHint);
            $this->storeInCache($classCacheKey, $reflectionClass);
        } else {
            $typeHint = NULL;
        }

        $this->storeInCache($paramCacheKey, $typeHint);

        return $typeHint;
    }

    /**
     * Retrieves and caches a reflection for the specified function
     *
     * @param string $functionName
     * @return \ReflectionFunction
     */
    public function getFunction($functionName) {
        $lowFunc = strtolower($functionName);
        $cacheKey = self::CACHE_KEY_FUNCS . '.' . $lowFunc;

        $reflectedFunc = $this->fetchFromCache($cacheKey);

        if (FALSE === $reflectedFunc) {
            $reflectedFunc = new \ReflectionFunction($functionName);
            $this->storeInCache($cacheKey, $reflectedFunc);
        }

        return $reflectedFunc;
    }

    /**
     * Retrieves and caches a reflection for the specified class method
     *
     * @param mixed $classNameOrInstance
     * @param string $methodName
     * @return \ReflectionMethod
     */
    public function getMethod($classNameOrInstance, $methodName) {
        $className = is_string($classNameOrInstance)
            ? $classNameOrInstance
            : get_class($classNameOrInstance);

        $lowClass = strtolower($className);
        $lowMethod = strtolower($methodName);
        $cacheKey = self::CACHE_KEY_METHODS . '.' . $lowClass . '.' . $lowMethod;

        if (!$reflectedMethod = $this->fetchFromCache($cacheKey)) {
            $reflectedMethod = new \ReflectionMethod($className, $methodName);
            $this->storeInCache($cacheKey, $reflectedMethod);
        }

        return $reflectedMethod;
    }
}
