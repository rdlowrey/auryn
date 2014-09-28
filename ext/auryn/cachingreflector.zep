
namespace Auryn;

class CachingReflector implements ReflectorInterface
{
    const CACHE_KEY_CLASSES = "auryn.refls.classes.";
    const CACHE_KEY_CTORS = "auryn.refls.ctors.";
    const CACHE_KEY_CTOR_PARAMS = "auryn.refls.ctor-params.";
    const CACHE_KEY_FUNCS = "auryn.refls.funcs.";
    const CACHE_KEY_METHODS = "auryn.refls.methods.";

    protected reflector;
    protected cache;

    public function __construct(<ReflectorInterface> reflector = null, <ReflectionCacheInterface> cache = null)
    {
        if unlikely typeof reflector == "null" {
            let this->reflector = new StandardReflector;
        } else {
            let this->reflector = reflector;
        }

        if unlikely typeof cache == "null" {
            let this->cache = new ReflectionCacheArray;
        } else {
            let this->cache = cache;
        }
    }

    public function getClass(string! className) -> <\ReflectionClass>
    {
        var cacheKey, reflectionClass;

        let cacheKey = self::CACHE_KEY_CLASSES . strtolower(className);
        let reflectionClass = this->cache->$fetch(cacheKey);

        if !reflectionClass {
            let reflectionClass = new \ReflectionClass(className);
            this->cache->store(cacheKey, reflectionClass);
        }

        return reflectionClass;
    }

    public function getCtor(string! className) -> <\ReflectionMethod>
    {
        var cacheKey, reflectedCtor, reflectionClass;
        let cacheKey = self::CACHE_KEY_CTORS.strtolower(className);

        let reflectedCtor = this->cache->$fetch(cacheKey);

        if !reflectedCtor {
            let reflectionClass = this->getClass(className);
            let reflectedCtor = reflectionClass->getConstructor();
            this->cache->store(cacheKey, reflectedCtor);
        }

        return reflectedCtor;
    }

    public function getCtorParams(string! className) -> array
    {
        var cacheKey, reflectedCtorParams, reflectedCtor;

        let cacheKey = self::CACHE_KEY_CTOR_PARAMS.strtolower(className);
        let reflectedCtorParams = this->cache->$fetch(cacheKey);

        if reflectedCtorParams {
            return reflectedCtorParams;
        } else {
            let reflectedCtor = this->getCtor(className);
            if reflectedCtor {
                let reflectedCtorParams = reflectedCtor->getParameters();
            } else {
                let reflectedCtorParams = null;
            }
        }

        this->cache->store(cacheKey, reflectedCtorParams);

        return reflectedCtorParams;
    }

    public function getParamTypeHint(<\ReflectionFunctionAbstract> $function, <\ReflectionParameter> param) -> <\ReflectionParameter>
    {
        var lowParam, lowClass, lowMethod, lowFunc, paramCacheKey;
        var classCacheKey, typeHint, reflectionClass;

        let lowParam = strtolower(param->name);

        if ($function instanceof \ReflectionMethod) {
            let lowClass = strtolower($function->$class);
            let lowMethod = strtolower($function->name);
            let paramCacheKey = self::CACHE_KEY_CLASSES . lowClass . "." . lowMethod . "." . param . "-" . lowParam;
        } else {
            let lowFunc = strtolower($function->name);
            if lowFunc != "{closure}" {
                let paramCacheKey = self::CACHE_KEY_FUNCS . "." . lowFunc . "." . param . "-" . lowParam;
            } else {
                let paramCacheKey = null;
            }
        }

        if typeof paramCacheKey == "null" {
            let typeHint = false;
        } else {
            let typeHint = this->cache->$fetch(paramCacheKey);
        }

        if typeHint != false {
            return typeHint;
        }

        let reflectionClass = param->getClass();
        if reflectionClass {
            let typeHint = reflectionClass->getName();
            let classCacheKey = self::CACHE_KEY_CLASSES . strtolower(typeHint);
            this->cache->store(classCacheKey, reflectionClass);
        } else {
            let typeHint = null;
        }

        this->cache->store(paramCacheKey, typeHint);

        return typeHint;
    }

    public function getFunction(string! functionName) -> <\ReflectionFunction>
    {
        var lowFunc, cacheKey, reflectedFunc;

        let lowFunc = strtolower(functionName);
        let cacheKey = self::CACHE_KEY_FUNCS . lowFunc;

        let reflectedFunc = this->cache->$fetch(cacheKey);

        if !reflectedFunc {
            let reflectedFunc = new \ReflectionFunction(functionName);
            this->cache->store(cacheKey, reflectedFunc);
        }

        return reflectedFunc;
    }

    public function getMethod(var classNameOrInstance, string! methodName) -> <\ReflectionMethod>
    {
        var className, cacheKey, reflectedMethod;

        if typeof classNameOrInstance == "string" {
            let className = classNameOrInstance;
        } else {
            let className = get_class(classNameOrInstance);
        }

        let cacheKey = self::CACHE_KEY_METHODS . strtolower(className) . "." . strtolower(methodName);

        let reflectedMethod = this->cache->$fetch(cacheKey);
        if !reflectedMethod {
            let reflectedMethod = new \ReflectionMethod(className, methodName);
            this->cache->store(cacheKey, reflectedMethod);
        }

        return reflectedMethod;
    }
}
