<?php

namespace Auryn;

/**
 * An interface for class dependency injectors
 */
interface Injector {

    /**
     * Auto-injects class constructor dependencies
     *
     * @param string $className
     * @param array $customDefinition
     */
    function make($className, array $customDefinition = NULL);

    /**
     * Defines custom instantiation parameters for the specified class
     *
     * @param string $className The class whose instantiation we wish to define
     * @param array $injectionDefinition An array mapping parameter names to classes and/or raw values
     */
    function define($className, array $injectionDefinition);

    /**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param string $paramName The parameter name for which this value applies
     * @param mixed $value The value to inject for this parameter name
     */
    function defineParam($paramName, $value);

    /**
     * Defines an alias class for all occurrences of a given typehint
     *
     * Use this method to specify implementation classes for interface and abstract class typehints.
     *
     * @param string $originalTypehint The typehint to replace
     * @param string $aliasClassName The implementation class name
     */
    function alias($originalTypehint, $aliasClassName);

    /**
     * Delegates the creation of $className instances to $callable
     *
     * @param string $className
     * @param callable $callable
     * @param array $args
     */
    function delegate($className, $callable, array $args = array());

    /**
     * Shares the specified class across the Injector context
     *
     * @param mixed $classNameOrInstance The class or object to share
     */
    function share($classNameOrInstance);

    /**
     * Unshares the specified class or the class of the specified instance
     *
     * @param string $classNameOrInstance The class or object to unshare
     */
    function unshare($classNameOrInstance);

    /**
     * Forces re-instantiation of a shared class the next time it is requested
     *
     * @param string $className The class name for which an existing share should be cleared for re-instantiation
     */
    function refresh($className);

    /**
     * Invoke the specified callable or class/method combo, provisioning any needed dependencies along the way.
     *
     * @param mixed $callableOrMethodArr Any valid PHP callable or an array of the form [$className, $methodName]
     * @param array $invocationArgs An optional array specifying params to invoke the provisioned callable
     * @param bool $makeAccessible If TRUE, protected/private methods will execute successfully
     */
    function execute($callableOrMethodArr, array $invocationArgs = array(), $makeAccessible = FALSE);

    /**
     * Generate and provision an executable from any PHP callable or class/method string array
     *
     * @param mixed $callableOrMethodArr Any valid PHP callable or an array of the form [$className, $methodName]
     * @param bool $makeAccessible If TRUE, protected/private methods will execute successfully
     */
    function getExecutable($callableOrMethodArr, $makeAccessible = FALSE);

}
