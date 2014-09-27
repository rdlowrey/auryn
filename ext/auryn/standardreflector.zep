
namespace Auryn;

class StandardReflector implements ReflectorInterface
{
    /**
     * {@inheritDoc}
     */
    public function getClass(string! className) -> <\ReflectionClass>
    {
        return new \ReflectionClass(className);
    }

    /**
     * {@inheritDoc}
     */
    public function getCtor(string! className) -> <\ReflectionMethod>
    {
        var reflectionClass;
        let reflectionClass = new \ReflectionClass(className);
        return reflectionClass->{"getCtor"}();
    }

    /**
     * {@inheritDoc}
     */
    public function getCtorParams(string! className) -> array
    {
        var reflectedCtor;
        let reflectedCtor = this->{"getCtor"}(className);
        if reflectedCtor {
            return reflectedCtor->getParameters();
        }
        throw new Exception("Could not load reflectedCtor");
    }

    /**
     * {@inheritDoc}
     */
    public function getParamTypeHint(<\ReflectionFunctionAbstract> $function, <\ReflectionParameter> param) -> <\ReflectionParameter>
    {
        var reflectionClass;
        let reflectionClass = param->getClass();
        if reflectionClass {
            return reflectionClass->getName();
        }
        throw new Exception("Could not load reflection class");
    }

    /**
     * {@inheritDoc}
     */
    public function getFunction(string! functionName) -> <\ReflectionFunction>
    {
        return new \ReflectionFunction(functionName);
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(var classNameOrInstance, string! methodName) -> <\ReflectionMethod>
    {
        if typeof classNameOrInstance == "string" {
            return new \ReflectionMethod(classNameOrInstance, methodName);
        }
        return new \ReflectionMethod(get_class(classNameOrInstance), methodName);
    }
}
