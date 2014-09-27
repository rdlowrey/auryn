
namespace Auryn;

class Invokable
{
    private reflFunc;
    private invokeObj;
    private isInstanceMethod;

    public function __construct(<\ReflectionFunctionAbstract> reflFunc, var invokeObj = null)
    {
        if (reflFunc instanceof \ReflectionMethod) {
            let this->isInstanceMethod = true;
            this->setMethodCallable(reflFunc, invokeObj);
        } else {
            let this->isInstanceMethod = false;
            let this->reflFunc = reflFunc;
        }
    }

    private function setMethodCallable(<\ReflectionMethod> reflection, var invokeObj)
    {
        if typeof invokeObj == "object" {
            let this->reflFunc = reflection;
            let this->invokeObj = invokeObj;
        } else {
            if (reflection->isStatic()) {
                let this->reflFunc = reflection;
            } else {
                throw new \Exception("ReflectionMethod callables must specify an invocation object");
            }
        }
    }

    public function __invoke()
    {
        var args;
        let args = func_get_args();

        if this->isInstanceMethod {
            return this->reflFunc->invokeArgs(this->invokeObj, args);
        }
        return this->reflFunc->invokeArgs(args);
    }

    public function getCallableReflection()
    {
        return this->reflFunc;
    }

    public function getInvocationObject()
    {
        return this->invokeObj;
    }

    public function isInstanceMethod()
    {
        return this->isInstanceMethod;
    }
}
