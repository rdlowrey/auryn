<?php

namespace Auryn;

class Injector
{
    const A_CLASS = ':';
    const A_DELEGATE = '+';
    const A_DEFINE = '@';
    const I_BINDINGS = 1;
    const I_DELEGATES = 2;
    const I_MUTATORS = 4;
    const I_ALIASES = 8;
    const I_SHARES = 16;
    const I_ALL = 17;
    const E_NON_EMPTY_STRING_ALIAS = 1;
    const E_SHARED_CANNOT_ALIAS = 2;
    const E_SHARE_ARGUMENT = 3;
    const E_ALIASED_CANNOT_SHARE = 4;
    const E_INVOKABLE = 5;
    const E_NON_PUBLIC_CONSTRUCTOR = 6;
    const E_NEEDS_DEFINITION = 7;
    const E_MAKE_FAILURE = 8;
    const E_UNDEFINED_PARAM = 9;
    const E_DELEGATE_ARGUMENT = 10;
    const E_CYCLIC_DEPENDENCY = 11;

    protected $reflector;
    protected $bindings = array();
    protected $aliases = array();
    protected $shares = array();
    protected $mutators = array();
    protected $delegates = array();
    protected $paramDefinitions = array();
    protected $inProgress = array();
    protected static $errorMessages = array(
        self::E_NON_EMPTY_STRING_ALIAS => 'Invalid alias: non-empty string required at both Argument 1 and Argument 2',
        self::E_SHARED_CANNOT_ALIAS => 'Cannot alias class %s to %s: it is already shared',
        self::E_SHARE_ARGUMENT => '%s::share() requires a string class name or object instance at Argument 1; %s specified',
        self::E_ALIASED_CANNOT_SHARE => 'Cannot share class %s, it has already been aliased to %s',
        self::E_INVOKABLE => 'Invalid invokable: callable or provisional string required',
        self::E_NON_PUBLIC_CONSTRUCTOR => 'Cannot instantiate class %s; constructor method is protected/private',
        self::E_NEEDS_DEFINITION => 'Injection definition/implementation required for non-concrete parameter $%s of type %s',
        self::E_MAKE_FAILURE => "Could not make %s: %s",
        self::E_UNDEFINED_PARAM => 'No definition available while attempting to provision typeless non-concrete parameter %s(%s)',
        self::E_DELEGATE_ARGUMENT => '%s::delegate expects a valid callable or provisionable executable class or method reference at Argument 2',
        self::E_CYCLIC_DEPENDENCY => "Detected a cyclic dependency while provisioning %s",
    );

    public function __construct(ReflectorInterface $reflector = null)
    {
        $this->reflector = $reflector ?: new CachingReflector();
    }

    /**
     * Bind instantiation directives for the specified class
     *
     * @param  string $name The class (or alias) whose constructor arguments we wish to bind
     * @param  array  $args An array mapping parameter names to values/instructions
     * @return self
     */
    public function bind($name, array $args)
    {
        $end = $this->resolveAlias($name);
        $normalizedName = end($end);
        $this->bindings[$normalizedName] = $args;

        return $this;
    }

    /**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param  string $paramName The parameter name for which this value applies
     * @param  mixed  $value     The value to inject for this parameter name
     * @return self
     */
    public function bindParam($paramName, $value)
    {
        $this->paramDefinitions[$paramName] = $value;

        return $this;
    }

    /**
     * Define an alias for all occurrences of a given typehint
     *
     * Use this method to specify implementation classes for interface and abstract class typehints.
     *
     * @param  string $original The typehint to replace
     * @param  string $alias    The implementation name
     * @return self
     */
    public function alias($original, $alias)
    {
        if (empty($original) || !is_string($original)) {
            throw new InjectorException(
                self::$errorMessages[self::E_NON_EMPTY_STRING_ALIAS],
                self::E_NON_EMPTY_STRING_ALIAS
            );
        }
        if (empty($alias) || !is_string($alias)) {
            throw new InjectorException(
                self::$errorMessages[self::E_NON_EMPTY_STRING_ALIAS],
                self::E_NON_EMPTY_STRING_ALIAS
            );
        }

        $originalNormalized = $this->normalizeName($original);

        if (isset($this->shares[$originalNormalized])) {
            throw new InjectorException(
                sprintf(
                    self::$errorMessages[self::E_SHARED_CANNOT_ALIAS],
                    $this->normalizeName(get_class($this->shares[$originalNormalized])),
                    $alias
                ),
                self::E_SHARED_CANNOT_ALIAS
            );
        }

        if (array_key_exists($originalNormalized, $this->shares)) {
            $aliasNormalized = $this->normalizeName($alias);
            $this->shares[$aliasNormalized] = null;
            unset($this->shares[$originalNormalized]);
        }

        $this->aliases[$originalNormalized] = $alias;

        return $this;
    }

    protected function normalizeName($className)
    {
        return ltrim(strtolower($className), '\\');
    }

    /**
     * Share the specified class/instance across the Injector context
     *
     * @param  mixed $nameOrInstance The class or object to share
     * @return self
     */
    public function share($nameOrInstance)
    {
        if (is_string($nameOrInstance)) {
            $this->shareClass($nameOrInstance);
        } elseif (is_object($nameOrInstance)) {
            $this->shareInstance($nameOrInstance);
        } else {
            throw new InjectorException(
                sprintf(
                    self::$errorMessages[self::E_SHARE_ARGUMENT],
                    __CLASS__,
                    gettype($nameOrInstance)
                ),
                self::E_SHARE_ARGUMENT
            );
        }

        return $this;
    }

    protected function shareClass($nameOrInstance)
    {
        list(, $normalizedName) = $this->resolveAlias($nameOrInstance);
        $this->shares[$normalizedName] = isset($this->shares[$normalizedName])
            ? $this->shares[$normalizedName]
            : null;
    }

    protected function resolveAlias($name)
    {
        $normalizedName = $this->normalizeName($name);
        if (isset($this->aliases[$normalizedName])) {
            $name = $this->aliases[$normalizedName];
            $normalizedName = $this->normalizeName($name);
        }

        return array($name, $normalizedName);
    }

    protected function shareInstance($obj)
    {
        $normalizedName = $this->normalizeName(get_class($obj));
        if (isset($this->aliases[$normalizedName])) {
            // You cannot share an instance of a class name that is already aliased
            throw new InjectorException(
                sprintf(
                    self::$errorMessages[self::E_ALIASED_CANNOT_SHARE],
                    $normalizedName,
                    $this->aliases[$normalizedName]
                ),
                self::E_ALIASED_CANNOT_SHARE
            );
        }
        $this->shares[$normalizedName] = $obj;
    }

    /**
     * Register a mutator callable to modify/prepare objects of type $name after instantiation
     *
     * Any callable or provisionable invokable may be specified. Preparers are passed two
     * arguments: the instantiated object to be mutated and the current Injector instance.
     *
     * @param  string $name
     * @param  mixed  $callableOrMethodStr Any callable or provisionable invokable method
     * @return self
     */
    public function mutate($name, $callableOrMethodStr)
    {
        if ($this->isInvokable($callableOrMethodStr) === false) {
            throw new InjectorException(
                self::$errorMessages[self::E_INVOKABLE],
                self::E_INVOKABLE
            );
        }

        $end = $this->resolveAlias($name);
        $normalizedName = end($end);
        $this->mutators[$normalizedName] = $callableOrMethodStr;

        return $this;
    }

    protected function isInvokable($exe)
    {
        if (is_callable($exe)) {
            return true;
        }

        if (is_string($exe) && method_exists($exe, '__invoke')) {
            return true;
        }

        if (is_array($exe) && isset($exe[0], $exe[1]) && method_exists($exe[0], $exe[1])) {
            return true;
        }

        return false;
    }

    /**
     * Delegate the creation of $name instances to the specified callable
     *
     * @param  string $name
     * @param  mixed  $callableOrMethodStr Any callable or provisionable invokable method
     * @return self
     */
    public function delegate($name, $callableOrMethodStr)
    {
        if ($this->isInvokable($callableOrMethodStr) === false) {
            throw new InjectorException(
                sprintf(self::$errorMessages[self::E_DELEGATE_ARGUMENT], __CLASS__),
                self::E_DELEGATE_ARGUMENT
            );
        }

        $normalizedName = $this->normalizeName($name);
        $this->delegates[$normalizedName] = $callableOrMethodStr;

        return $this;
    }

    /**
     * Retrieve stored data for the specified definition type
     *
     * Exposes introspection of existing binds/delegates/shares/etc. for decoration and composition.
     *
     * @param  string $nameFilter An optional class name filter
     * @param  int    $typeFilter A bitmask of Injector::* type constant flags
     * @return array
     */
    public function inspect($nameFilter = null, $typeFilter = null)
    {
        $result = array();
        $name = $nameFilter ? $this->normalizeName($nameFilter) : null;

        if (empty($typeFilter)) {
            $typeFilter = self::I_ALL;
        }

        if ($typeFilter & self::I_BINDINGS && ($elements = $this->filter($this->bindings, $name))) {
            $result[self::I_BINDINGS] = $elements;
        }
        if ($typeFilter & self::I_DELEGATES && ($elements = $this->filter($this->delegates, $name))) {
            $result[self::I_DELEGATES] = $elements;
        }
        if ($typeFilter & self::I_MUTATORS && ($elements = $this->filter($this->mutators, $name))) {
            $result[self::I_MUTATORS] = $elements;
        }
        if ($typeFilter & self::I_ALIASES && ($elements = $this->filter($this->aliases, $name))) {
            $result[self::I_ALIASES] = $elements;
        }
        if ($typeFilter & self::I_SHARES && ($elements = $this->filter($this->shares, $name))) {
            $result[self::I_SHARES] = $elements;
        }

        return $result;
    }

    protected function filter($source, $name)
    {
        if (empty($name)) {
            return $source;
        } elseif (isset($source[$name])) {
            return $source[$name];
        } else {
            return array();
        }
    }

    /**
     * Instantiate/provision a class instance
     *
     * @param  string $name
     * @param  array  $args
     * @return mixed
     */
    public function make($name, array $args = array())
    {
        list($className, $normalizedClass) = $this->resolveAlias($name);

        if (isset($this->inProgress[$normalizedClass])) {
            throw new InjectorException(
                sprintf(
                    self::$errorMessages[self::E_CYCLIC_DEPENDENCY],
                    $className
                ),
                self::E_CYCLIC_DEPENDENCY
            );
        }

        $this->inProgress[$normalizedClass] = true;

        // isset() is used specifically here because classes may be marked as "shared" before an
        // instance is stored. In these cases the class is "shared," but it has a null value and
        // instantiation is needed.
        if (isset($this->shares[$normalizedClass])) {
            unset($this->inProgress[$normalizedClass]);

            return $this->shares[$normalizedClass];
        }

        if (isset($this->delegates[$normalizedClass])) {
            $invokable = $this->makeInvokable($this->delegates[$normalizedClass]);
            $obj = $invokable($className, $this);
        } else {
            $obj = $this->provisionInstance($className, $normalizedClass, $args);
        }

        if (array_key_exists($normalizedClass, $this->shares)) {
            $this->shares[$normalizedClass] = $obj;
        }

        $this->mutateInstance($obj, $normalizedClass);

        unset($this->inProgress[$normalizedClass]);

        return $obj;
    }

    protected function provisionInstance($className, $normalizedClass, array $definition)
    {
        try {
            $ctor = $this->reflector->getCtor($className);

            if (!$ctor) {
                $obj = $this->instantiateWithoutCtorParams($className);
            } elseif (!$ctor->isPublic()) {
                throw new InjectorException(
                    sprintf(self::$errorMessages[self::E_NON_PUBLIC_CONSTRUCTOR], $className),
                    self::E_NON_PUBLIC_CONSTRUCTOR
                );
            } elseif ($ctorParams = $this->reflector->getCtorParams($className)) {
                $reflClass = $this->reflector->getClass($className);
                $definition = isset($this->bindings[$normalizedClass])
                    ? array_replace($this->bindings[$normalizedClass], $definition)
                    : $definition;
                $args = $this->provisionFuncArgs($ctor, $definition);
                $obj = $reflClass->newInstanceArgs($args);
            } else {
                $obj = $this->instantiateWithoutCtorParams($className);
            }

            return $obj;
        } catch (\ReflectionException $e) {
            throw new InjectorException(
                sprintf(self::$errorMessages[self::E_MAKE_FAILURE], $className, $e->getMessage()),
                self::E_MAKE_FAILURE,
                $e
            );
        }
    }

    protected function instantiateWithoutCtorParams($className)
    {
        $reflClass = $this->reflector->getClass($className);

        if (!$reflClass->isInstantiable()) {
            $type = $reflClass->isInterface() ? 'interface' : 'abstract';
            throw new InjectorException(
                sprintf(self::$errorMessages[self::E_NEEDS_DEFINITION], $type, $className),
                self::E_NEEDS_DEFINITION
            );
        }

        return new $className();
    }

    protected function provisionFuncArgs(\ReflectionFunctionAbstract $reflFunc, array $definition)
    {
        $args = array();

        // @TODO store this in ReflectionStorage
        $reflParams = $reflFunc->getParameters();

        foreach ($reflParams as $i => $reflParam) {
            $name = $reflParam->name;

            if (isset($definition[$i]) || array_key_exists($i, $definition)) {
                // indexed arguments take precedence over named parameters
                $arg = $definition[$i];
            } elseif (isset($definition[$name]) || array_key_exists($name, $definition)) {
                $arg = $definition[$name];
            } elseif (($prefix = self::A_CLASS.$name) && isset($definition[$prefix])) {
                // interpret the param as a class name to be instantiated
                $arg = $this->make($definition[$prefix]);
            } elseif (($prefix = self::A_DELEGATE.$name) && isset($definition[$prefix])) {
                // interpret the param as an invokable delegate
                $arg = $this->buildArgFromDelegate($name, $definition[$prefix]);
            } elseif (($prefix = self::A_DEFINE.$name) && isset($definition[$prefix])) {
                // interpret the param as a class definition
                $arg = $this->buildArgFromParamDefineArr($definition[$prefix]);
            } elseif (!$arg = $this->buildArgFromTypeHint($reflFunc, $reflParam)) {
                $arg = $this->buildArgFromReflParam($reflParam);
            }

            $args[] = $arg;
        }

        return $args;
    }

    protected function buildArgFromParamDefineArr($definition)
    {
        if (!is_array($definition)) {
            throw new InjectorException(
                // @TODO Add message
            );
        }

        if (!isset($definition[0], $definition[1])) {
            throw new InjectorException(
                // @TODO Add message
            );
        }

        list($class, $definition) = $definition;

        return $this->make($class, $definition);
    }

    protected function buildArgFromDelegate($paramName, $callableOrMethodStr)
    {
        if ($this->isInvokable($callableOrMethodStr) === false) {
            throw new InjectorException(
                self::$errorMessages[self::E_INVOKABLE],
                self::E_INVOKABLE
            );
        }

        $invokable = $this->makeInvokable($callableOrMethodStr);

        return $invokable($paramName, $this);
    }

    protected function buildArgFromTypeHint(\ReflectionFunctionAbstract $reflFunc, \ReflectionParameter $reflParam)
    {
        $typeHint = $this->reflector->getParamTypeHint($reflFunc, $reflParam);

        if (!$typeHint) {
            $obj = null;
        } elseif ($reflParam->isDefaultValueAvailable()) {
            $obj = $reflParam->getDefaultValue();
        } else {
            $obj = $this->make($typeHint);
        }

        return $obj;
    }

    protected function buildArgFromReflParam(\ReflectionParameter $reflParam)
    {
        if (array_key_exists($reflParam->name, $this->paramDefinitions)) {
            $arg = $this->paramDefinitions[$reflParam->name];
        } elseif ($reflParam->isDefaultValueAvailable()) {
            $arg = $reflParam->getDefaultValue();
        } elseif ($reflParam->isOptional()) {
            // This branch is required to work around PHP bugs where a parameter is optional
            // but has no default value available through reflection. Specifically, PDO exhibits
            // this behavior.
            $arg = null;
        } else {
            $reflFunc = $reflParam->getDeclaringFunction();
            $classWord = ($reflFunc instanceof \ReflectionMethod)
                ? $reflFunc->getDeclaringClass()->name.'::'
                : '';
            $funcWord = $reflFunc->name;

            throw new InjectorException(
                sprintf(
                    self::$errorMessages[self::E_UNDEFINED_PARAM],
                    $classWord.$funcWord,
                    $reflParam->name
                ),
                self::E_UNDEFINED_PARAM
            );
        }

        return $arg;
    }

    protected function mutateInstance($obj, $normalizedClass)
    {
        if (isset($this->mutators[$normalizedClass])) {
            $mutator = $this->mutators[$normalizedClass];
            $invokable = $this->makeInvokable($mutator);
            $invokable($obj, $this);
        }
        if ($interfaces = class_implements($obj)) {
            $interfaces = array_flip(array_map(array($this, 'normalizeName'), $interfaces));
            $mutators = array_intersect_key($this->mutators, $interfaces);
            foreach ($mutators as $mutator) {
                $invokable = $this->makeInvokable($mutator);
                $invokable($obj, $this);
            }
        }
    }

    /**
     * Provision an Invokable instance from any valid callable or class/method string
     *
     * @param  mixed           $callableOrMethodStr A valid PHP callable or a provisionable ClassName::methodName string
     * @return Auryn\Invokable
     */
    public function makeInvokable($callableOrMethodStr)
    {
        list($reflFunc, $invocationObj) = $this->generateInvokables($callableOrMethodStr);

        return new Invokable($reflFunc, $invocationObj);
    }

    /**
     * Provision arguments for the specified callable or class/method string
     *
     * If $callableOrMethodStr is a provisioned Auryn\Invokable instance arguments is
     * generated for the method/function underlying the invokable instance.
     *
     * @param  mixed $callableOrMethodStr A callable or a provisionable ClassName::methodName string
     * @param  array $args                Optional definition to use when provisioning args
     * @return array An array of provisioned arguments to use for invocation
     */
    public function makeArguments($callableOrMethodStr, array $args = array())
    {
        $reflFunc = ($callableOrMethodStr instanceof Invokable)
            ? $callableOrMethodStr->getCallableReflection()
            : current($this->generateInvokables($callableOrMethodStr));

        return $this->provisionFuncArgs($reflFunc, $args);
    }

    protected function generateInvokables($callableOrMethodStr)
    {
        if (is_string($callableOrMethodStr)) {
            $invokableArr = $this->generateInvokablesFromString($callableOrMethodStr);
        } elseif ($callableOrMethodStr instanceof \Closure) {
            $callableRefl = new \ReflectionFunction($callableOrMethodStr);
            $invokableArr = array($callableRefl, null);
        } elseif (is_object($callableOrMethodStr) && is_callable($callableOrMethodStr)) {
            $invocationObj = $callableOrMethodStr;
            $callableRefl = $this->reflector->getMethod($invocationObj, '__invoke');
            $invokableArr = array($callableRefl, $invocationObj);
        } elseif (is_array($callableOrMethodStr)
            && isset($callableOrMethodStr[0], $callableOrMethodStr[1])
            && count($callableOrMethodStr) === 2
        ) {
            $invokableArr = $this->generateInvokablesFromArray($callableOrMethodStr);
        } else {
            throw new InjectorException(
                self::$errorMessages[self::E_INVOKABLE],
                self::E_INVOKABLE
            );
        }

        return $invokableArr;
    }

    protected function generateInvokablesFromString($stringInvokable)
    {
        if (function_exists($stringInvokable)) {
            $callableRefl = $this->reflector->getFunction($stringInvokable);
            $invokableArr = array($callableRefl, null);
        } elseif (method_exists($stringInvokable, '__invoke')) {
            $invocationObj = $this->make($stringInvokable);
            $callableRefl = $this->reflector->getMethod($invocationObj, '__invoke');
            $invokableArr = array($callableRefl, $invocationObj);
        } elseif (strpos($stringInvokable, '::') !== false) {
            list($class, $method) = explode('::', $stringInvokable, 2);
            $invokableArr = $this->generateStringClassMethodCallable($class, $method);
        } else {
            throw new InjectorException(
                self::$errorMessages[self::E_INVOKABLE],
                self::E_INVOKABLE
            );
        }

        return $invokableArr;
    }

    protected function generateStringClassMethodCallable($class, $method)
    {
        $relativeStaticMethodStartPos = strpos($method, 'parent::');

        if ($relativeStaticMethodStartPos === 0) {
            $childReflection = $this->reflector->getClass($class);
            $class = $childReflection->getParentClass()->name;
            $method = substr($method, $relativeStaticMethodStartPos + 8);
        }

        $reflectionMethod = $this->reflector->getMethod($class, $method);

        return $reflectionMethod->isStatic()
            ? array($reflectionMethod, null)
            : array($reflectionMethod, $this->make($class));
    }

    protected function generateInvokablesFromArray($arrayInvokable)
    {
        list($classOrObj, $method) = $arrayInvokable;

        if (is_object($classOrObj) && method_exists($classOrObj, $method)) {
            $callableRefl = $this->reflector->getMethod($classOrObj, $method);
            $invokableArr = array($callableRefl, $classOrObj);
        } elseif (is_string($classOrObj)) {
            $invokableArr = $this->generateStringClassMethodCallable($classOrObj, $method);
        } else {
            throw new InjectorException(
                self::$errorMessages[self::E_INVOKABLE],
                self::E_INVOKABLE
            );
        }

        return $invokableArr;
    }
}
