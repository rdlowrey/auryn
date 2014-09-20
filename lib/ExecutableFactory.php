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
            $executableArr = array($callableRefl, $classOrObj);
        } elseif (is_string($classOrObj)) {
            $executableArr = $this->generateStringClassMethodCallable($classOrObj, $method);
        } else {
            throw new BadArgumentException(
                \Auryn\Provider::$errorMessages[\Auryn\Provider::E_CALLABLE],
                \Auryn\Provider::E_CALLABLE
            );
        }

        return $executableArr;
    }


    private function generateStringClassMethodCallable($class, $method) {
        $relativeStaticMethodStartPos = strpos($method, 'parent::');

        if ($relativeStaticMethodStartPos === 0) {
            $childReflection = $this->reflectionStorage->getClass($class);
            $class = $childReflection->getParentClass()->name;
            $method = substr($method, $relativeStaticMethodStartPos + 8);
        }

        $reflectionMethod = $this->reflectionStorage->getMethod($class, $method);

        return $reflectionMethod->isStatic()
            ? array($reflectionMethod, NULL)
            : array($reflectionMethod, $this->injector->make($class));
    }
    

    public function generateExecutableReflection($exeCallable, $makeAccessible = false) {

        if (is_string($exeCallable)) {
            $executableArr = $this->generateExecutableFromString($exeCallable);
        } elseif ($exeCallable instanceof \Closure) {
//            $callableRefl = new \ReflectionFunction($exeCallable);
//            $executableArr = array($callableRefl, NULL);
            return new ClosureExecutable($exeCallable);
        } elseif (is_object($exeCallable) && is_callable($exeCallable)) {
            $invocationObj = $exeCallable;
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (is_array($exeCallable)
            && isset($exeCallable[0], $exeCallable[1])
            && count($exeCallable) === 2
        ) {
            $executableArr = $this->generateExecutableFromArray($exeCallable);
        } else {
            throw new BadArgumentException(
                \Auryn\Provider::$errorMessages[\Auryn\Provider::E_CALLABLE],
                \Auryn\Provider::E_CALLABLE
            );
        }

        list($reflectionFunction, $invocationObject) = $executableArr;

        if ($makeAccessible
            && $reflectionFunction instanceof \ReflectionMethod
            && !$reflectionFunction->isPublic()
        ) {
            $reflectionFunction->setAccessible(TRUE);
        }

        return new Executable($reflectionFunction, $invocationObject);
    }

    private function generateExecutableFromString($stringExecutable) {
        if (function_exists($stringExecutable)) {
            $callableRefl = $this->reflectionStorage->getFunction($stringExecutable);
            $executableArr = array($callableRefl, NULL);
        } elseif (method_exists($stringExecutable, '__invoke')) {
            $invocationObj = $this->injector->make($stringExecutable);
            $callableRefl = $this->reflectionStorage->getMethod($invocationObj, '__invoke');
            $executableArr = array($callableRefl, $invocationObj);
        } elseif (strpos($stringExecutable, '::') !== FALSE) {
            list($class, $method) = explode('::', $stringExecutable, 2);
            $executableArr = $this->generateStringClassMethodCallable($class, $method);
        } else {
            throw new BadArgumentException(
                \Auryn\Provider::$errorMessages[\Auryn\Provider::E_CALLABLE],
                \Auryn\Provider::E_CALLABLE
            );
        }

        return $executableArr;
    }


}

 