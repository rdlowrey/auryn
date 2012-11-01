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
     * Determines if an injection definition exists for the specified class
     * 
     * @param string $className
     */
    function isDefined($className);
    
    /**
     * Defines multiple custom instantiation parameters at once
     * 
     * @param mixed $iterable The variable to iterate over: an array, StdClass or Traversable
     */
    function defineAll($iterable);
    
    /**
     * Clears a previously-defined injection definition
     * 
     * @param string $className
     */
    function clearDefinition($className);
    
    /**
     * Clears all injection definitions from the container
     */
    function clearAllDefinitions();
    
    /**
     * Defines an implementation class for all occurrences of a given interface or abstract class
     * 
     * @param string $nonConcreteType
     * @param string $className
     */
    function implement($nonConcreteType, $className);
    
    /**
     * Determines if an implementation definition exists for the non-concrete type
     * 
     * @param string $nonConcreteType
     */
    function isImplemented($nonConcreteType);
    
    /**
     * Defines multiple type implementations at one time
     * 
     * @param mixed $iterable The variable to iterate over: an array, StdClass or Traversable
     */
    function implementAll($iterable);
    
    /**
     * Clears an existing implementation class for the specified non-concrete type
     * 
     * @param string $nonConcreteType
     */
    function clearImplementation($nonConcreteType);
    
    /**
     * Clears all existing non-concrete implementations
     */
    function clearAllImplementations();
    
    /**
     * Shares the specified class
     * 
     * @param mixed $classNameOrInstance
     */
    function share($classNameOrInstance);
    
    /**
     * Shares all specified classes/instances
     * 
     * @param mixed $arrayOrTraversableObject
     */
    function shareAll($arrayOrTraversableObject);
    
    /**
     * Determines if a given class name is marked as shared
     * 
     * @param string $className
     */
    function isShared($className);
    
    /**
     * Forces re-instantiation of a shared class the next time it is requested
     * 
     * @param string $className
     */
    function refreshShare($className);
    
    /**
     * Unshares the specified class
     * 
     * @param string $className
     */
    function unShare($className);

    /**
     * Delegates the creation of $class to $callable.  Passes $class to $callable as the only
     * argument
     *
     * @param string $class
     * @param callable $callable
     * @throws \BadFunctionCallException
     */
    function delegate($class, $callable);
    
    /**
     * Is a delegate registered for the specified class?
     * 
     * @param string $class
     */
    function hasDelegate($class);
    
    /**
     * Remove a delegate for the specified class.
     * 
     * @param string $class
     */
    function clearDelegate($class);
}
