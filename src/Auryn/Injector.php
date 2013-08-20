<?php

namespace Auryn;

/**
 * An interface for class dependency injection containers
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
     * @param string $className
     * @param array $injectionDefinition
     */
    function define($className, array $injectionDefinition);
    
    /**
     * Defines an implementation class for all occurrences of a given typehint
     * 
     * @param string $originalTypehint
     * @param string $aliasClassName
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
     * @param mixed $classNameOrInstance
     */
    function share($classNameOrInstance);
    
    /**
     * Unshares the specified class
     * 
     * @param string $className
     */
    function unshare($className);
    
    /**
     * Forces re-instantiation of a shared class the next time it is requested
     * 
     * @param string $className
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
