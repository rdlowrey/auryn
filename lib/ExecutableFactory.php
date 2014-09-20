<?php


namespace Auryn;


class ExecutableFactory {

    /**
     * @var Injector
     */
    private $injector;

    /**
     * @var ReflectionStorage
     */
    private $reflectionStorage;
    
    function __construct(\Auryn\Injector $injector, ReflectionStorage $reflectionStorage) {
        $this->reflectionStorage = $reflectionStorage;
        $this->injector = $injector;
    }


    private function generateExecutableFromArray($arrayExecutable) {
        list($classOrObj, $method) = $arrayExecutable;

        if (is_object($classOrObj) && method_exists($classOrObj, $method)) {
            $callableRefl = $this->reflectionStorage->getMethod($classOrObj, $method);
            return new ReflectionMethodExecutable($callableRefl, $classOrObj);
        } elseif (is_string($classOrObj)) {
            return $this->generateStringClassMethodCallable($classOrObj, $method);
        }

        throw new BadArgumentException(
            \Auryn\Provider::$errorMessages[\Auryn\Provider::E_CALLABLE],
            \Auryn\Provider::E_CALLABLE
        );
    }


    private function generateStringClassMethodCallable($class, $method) {
        $relativeStaticMethodStartPos = strpos($method, 'parent::');

        if ($relativeStaticMethodStartPos === 0) {
            $childReflection = $this->reflectionStorage->getClass($class);
            $class = $childReflection->getParentClass()->name;
            $method = substr($method, $relativeStaticMethodStartPos + 8);
        }

        $reflectionMethod = $this->reflectionStorage->getMethod($class, $method);

        if ($reflectionMethod->isStatic()) {
            return new ReflectionMethodExecutable($reflectionMethod, null);
        }
        else {
            return new ReflectionMethodExecutable($reflectionMethod, $this->injector->make($class));
        }
    }
    

    public function generateExecutableReflection($exeCallable, $makeAccessible = false) {

        if (is_string($exeCallable)) {
            $executable = $this->generateExecutableFromString($exeCallable);
        } elseif ($exeCallable instanceof \Closure) {
            $executable = new ClosureExecutable($exeCallable);
        } elseif (is_object($exeCallable) && is_callable($exeCallable)) {
            $invocationObj = $exeCallable;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executable = new ReflectionMethodExecutable($callableRefl, $invocationObj);
        } elseif (is_array($exeCallable)
            && isset($exeCallable[0], $exeCallable[1])
            && count($exeCallable) === 2
        ) {
            $executable = $this->generateExecutableFromArray($exeCallable);
        } else {
            throw new BadArgumentException(
                \Auryn\Provider::$errorMessages[\Auryn\Provider::E_CALLABLE],
                \Auryn\Provider::E_CALLABLE
            );
        }

        if ($makeAccessible) {
            $executable->makeAccessible();
        }

        return $executable;
    }

    private function generateExecutableFromString($stringExecutable) {
        if (function_exists($stringExecutable)) {
            $callableRefl = $this->reflectionStorage->getFunction($stringExecutable);
            return new Executable($callableRefl, NULL);
        } elseif (method_exists($stringExecutable, '__invoke')) {
            $invocationObj = $this->injector->make($stringExecutable);
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            return new ReflectionMethodExecutable($callableRefl, $invocationObj);
        } elseif (strpos($stringExecutable, '::') !== FALSE) {
            list($class, $method) = explode('::', $stringExecutable, 2);
            return $this->generateStringClassMethodCallable($class, $method);
        } 

        throw new BadArgumentException(
            \Auryn\Provider::$errorMessages[\Auryn\Provider::E_CALLABLE],
            \Auryn\Provider::E_CALLABLE
        );
    }
}

 