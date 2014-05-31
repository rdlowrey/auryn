<?php


namespace Auryn\Plugin;

use Auryn\BadArgumentException;
use Auryn\InjectionException;
use Auryn\AurynInjector;

class StandardProviderPlugin implements ProviderInjectionPlugin {

    private $aliases = array();
    private $prepares = array();
    private $sharedClasses = array();
    private $delegatedClasses = array();
    private $paramDefinitions = array();
    private $injectionDefinitions = array();


    private function validateInjectionDefinition(array $injectionDefinition) {
        foreach ($injectionDefinition as $paramName => $value) {
            if ($paramName[0] !== AurynInjector::RAW_INJECTION_PREFIX && !is_string($value)) {
                throw new BadArgumentException(
                    sprintf(AurynInjector::$errorMessages[AurynInjector::E_RAW_PREFIX], $paramName, $paramName),
                    AurynInjector::E_RAW_PREFIX
                );
            }
        }
    }


    private function canExecute($exe) {
        if (is_callable($exe)) {
            return TRUE;
        }

        if (is_string($exe) && method_exists($exe, '__invoke')) {
            return TRUE;
        }

        if (is_array($exe) && isset($exe[0], $exe[1]) && method_exists($exe[0], $exe[1])) {
            return TRUE;
        }

        return FALSE;
    }

    public function normalizeClassName($className) {
        return ltrim(strtolower($className), '\\');
    }

    /**
     * Defines a custom injection definition for the specified class
     *
     * @param string $className
     * @param array $injectionDefinition An associative array matching constructor params to values
     * @throws \Auryn\BadArgumentException On missing raw injection prefix
     * @return \Auryn\Provider Returns the current instance
     */
    public function define($className, array $injectionDefinition) {
        $this->validateInjectionDefinition($injectionDefinition);
        $normalizedClass = $this->normalizeClassName($className);
        $this->injectionDefinitions[$normalizedClass] = $injectionDefinition;

        return $this;
    }

    /**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param string $paramName The parameter name for which this value applies
     * @param mixed $value The value to inject for this parameter name
     * @return \Auryn\Provider Returns the current instance
     */
    public function defineParam($paramName, $value) {
        $this->paramDefinitions[$paramName] = $value;

        return $this;
    }

    function isParamDefined($paramName) {
        return array_key_exists($paramName, $this->paramDefinitions);
    }

    function getParamDefine($paramName) {
        if (array_key_exists($paramName, $this->paramDefinitions)) {
            return array(true, $this->paramDefinitions[$paramName]);
        }

        return array(false, null);
    }
    

    /**
     * Defines an alias class name for all occurrences of a given typehint
     *
     * @param string $typehintToReplace
     * @param string $alias
     * @throws InjectionException
     * @throws BadArgumentException On non-empty string argument
     * @return \Auryn\Provider Returns the current instance
     */
    public function alias($typehintToReplace, $alias) {
        if (empty($typehintToReplace) || !is_string($typehintToReplace)) {
            throw new BadArgumentException(
                AurynInjector::$errorMessages[AurynInjector::E_NON_EMPTY_STRING_ALIAS],
                AurynInjector::E_NON_EMPTY_STRING_ALIAS
            );
        } elseif (empty($alias) || !is_string($alias)) {
            throw new BadArgumentException(
                AurynInjector::$errorMessages[AurynInjector::E_NON_EMPTY_STRING_ALIAS],
                AurynInjector::E_NON_EMPTY_STRING_ALIAS
            );
        }

        $normalizedTypehint = $this->normalizeClassName($typehintToReplace);
        $normalizedAlias = $this->normalizeClassName($alias);

        if (isset($this->sharedClasses[$normalizedTypehint])) {
            $sharedClassName = $this->normalizeClassName(get_class($this->sharedClasses[$normalizedTypehint]));
            throw new InjectionException(
                sprintf(AurynInjector::$errorMessages[AurynInjector::E_SHARED_CANNOT_ALIAS], $sharedClassName, $alias),
                AurynInjector::E_SHARED_CANNOT_ALIAS
            );
        } else {
            $this->aliases[$normalizedTypehint] = $alias;
        }

        if (array_key_exists($normalizedTypehint, $this->sharedClasses)) {
            $this->sharedClasses[$normalizedAlias] = $this->sharedClasses[$normalizedTypehint];
            unset($this->sharedClasses[$normalizedTypehint]);
        }

        return $this;
    }


    /**
     * Stores a shared instance of the specified class
     *
     * If an instance of the class is specified, it will be stored and shared
     * for calls to `Provider::make` for that class until the shared instance
     * is manually removed or refreshed.
     *
     * If a string class name is specified, the Provider will mark the class
     * as "shared" and the next time the Provider is used to instantiate the
     * class it's instance will be stored and shared.
     *
     * @param mixed $classNameOrInstance
     * @throws InjectionException
     * @throws BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    public function share($classNameOrInstance) {
        if (is_string($classNameOrInstance)) {
            $this->shareClass($classNameOrInstance);
        } elseif (is_object($classNameOrInstance)) {
            $this->shareObject($classNameOrInstance);
        } else {
            throw new BadArgumentException(
                sprintf(AurynInjector::$errorMessages[AurynInjector::E_SHARE_ARGUMENT], __CLASS__, gettype($classNameOrInstance)),
                AurynInjector::E_SHARE_ARGUMENT
            );
        }

        return $this;
    }


    /**
     * Unshares the specified class (or the class of the specified object)
     *
     * @param mixed $classNameOrInstance Class name or object instance
     * @return \Auryn\Provider Returns the current instance
     */
    public function unshare($classNameOrInstance) {
        $className = is_object($classNameOrInstance)
            ? get_class($classNameOrInstance)
            : $classNameOrInstance;
        $className = $this->normalizeClassName($className);

        unset($this->sharedClasses[$className]);

        return $this;
    }


    /**
     * Forces re-instantiation of a shared class the next time it's requested
     *
     * @param mixed $classNameOrInstance Class name or instance
     * @return \Auryn\Provider Returns the current instance
     */
    public function refresh($classNameOrInstance) {
        if (is_object($classNameOrInstance)) {
            $classNameOrInstance = get_class($classNameOrInstance);
        }
        $className = $this->normalizeClassName($classNameOrInstance);
        if (isset($this->sharedClasses[$className])) {
            $this->sharedClasses[$className] = NULL;
        }

        return $this;
    }


    /**
     * Delegates the creation of $class to $callable. Passes $class to $callable as the only argument
     *
     * @param string $className
     * @param callable $callable
     * @param array $args [optional]
     * @throws BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    public function delegate($className, $callable, array $args = array()) {
        if ($this->canExecute($callable)) {
            $delegate = array($callable, $args);
        } else {
            throw new BadArgumentException(
                sprintf(AurynInjector::$errorMessages[AurynInjector::E_DELEGATE_ARGUMENT], __CLASS__),
                AurynInjector::E_DELEGATE_ARGUMENT
            );
        }

        $normalizedClass =$this->normalizeClassName($className);
        $this->delegatedClasses[$normalizedClass] = $delegate;

        return $this;
    }

    function isDelegated($normalizedClass) {
        return isset($this->delegatedClasses[$normalizedClass]);
    }

    function getDelegated($className) {
        $normalizedName = $this->normalizeClassName($className);
        return $this->delegatedClasses[$normalizedName];
    }

    /**
     * Register a mutator callable to modify objects after instantiation
     *
     * @param string $classInterfaceOrTraitName
     * @param mixed $executable Any callable or provisionable executable method
     * @throws \Auryn\BadArgumentException
     * @return \Auryn\Provider Returns the current instance
     */
    public function prepare($classInterfaceOrTraitName, $executable) {
        if (!$this->canExecute($executable)) {
            throw new BadArgumentException(
                AurynInjector::$errorMessages[AurynInjector::E_CALLABLE],
                AurynInjector::E_CALLABLE
            );
        }

        $normalizedName = $this->normalizeClassName($classInterfaceOrTraitName);
        $this->prepares[$normalizedName] = $executable;

        return $this;
    }


    public function getPrepareDefine($classInterfaceOrTraitName) {
        $normalizedName = $this->normalizeClassName($classInterfaceOrTraitName);
        
        if (array_key_exists($normalizedName, $this->prepares)) {
            return $this->prepares[$normalizedName];
        }

        return null;
    }

    public function getInterfacePrepares($interfacesImplemented) {
        $preparationMethods = array_map(array($this, 'normalizeClassName'), $interfacesImplemented);
        $interfacesImplemented = array_flip($preparationMethods);
        $interfacePrepares = array_intersect_key($this->prepares, $interfacesImplemented);
    
        return $interfacePrepares;
    }
    

    public function getDefinition($className) {
        $normalizedClass = $this->normalizeClassName($className);

        return $this->isDefined($normalizedClass)
            ? $this->injectionDefinitions[$normalizedClass]
            : array();
    }


    private function isDefined($className) {
        $normalizedClass = $this->normalizeClassName($className);

        return isset($this->injectionDefinitions[$normalizedClass]);
    }


    private function isShared($className) {
        $normalizedClass = $this->normalizeClassName($className);

        return array_key_exists($normalizedClass, $this->sharedClasses);
    }


    public function shareIfNeeded($normalizedClass, $provisionedObject) {
        if ($this->isShared($normalizedClass)) {
            $this->sharedClasses[$normalizedClass] = $provisionedObject;
        }
    }

    private function shareClass($classNameOrInstance) {
        list(, $normalizedClass) = $this->resolveAlias($classNameOrInstance);

        $this->sharedClasses[$normalizedClass] = isset($this->sharedClasses[$normalizedClass])
            ? $this->sharedClasses[$normalizedClass]
            : NULL;
    }


    private function shareObject($classNameOrInstance) {
        $normalizedClass = $this->normalizeClassName(get_class($classNameOrInstance));
        if (isset($this->aliases[$normalizedClass])) {
            // You cannot share an instance of a class that has already been aliased to another class.
            throw new InjectionException(
                sprintf(AurynInjector::$errorMessages[AurynInjector::E_ALIASED_CANNOT_SHARE], $normalizedClass, $this->aliases[$normalizedClass]),
                AurynInjector::E_ALIASED_CANNOT_SHARE
            );
        }
        $this->sharedClasses[$normalizedClass] = $classNameOrInstance;
    }

    public function getShared($normalizedClass) {
        if (array_key_exists($normalizedClass, $this->sharedClasses) == true) {
            if ($this->sharedClasses == null) {
                return $normalizedClass;
            }
            return $this->sharedClasses[$normalizedClass];
        }
        

        return null;
    }

    public function resolveAlias($className) {
        $normalizedClass = $this->normalizeClassName($className);

        if (isset($this->aliases[$normalizedClass])) {
            $className = $this->aliases[$normalizedClass];
            $normalizedClass = $this->normalizeClassName($className);
        }
        return array($className, $normalizedClass);
    }

    
}

 