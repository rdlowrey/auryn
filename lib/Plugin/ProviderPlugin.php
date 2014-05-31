<?php


namespace Auryn\Plugin;


interface ProviderPlugin {

    /**
     * Defines custom instantiation parameters for the specified class
     *
     * @param string $className The class whose instantiation we wish to define
     * @param array $injectionDefinition An array mapping parameter names to classes and/or raw values
     * @param array $chainClassConstructors
     * @return
     */
    public function define($className, array $injectionDefinition, array $chainClassConstructors = array());

    /**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param string $paramName The parameter name for which this value applies
     * @param mixed $value The value to inject for this parameter name
     * @param array $chainClassConstructors
     * @return
     */
    public function defineParam($paramName, $value, array $chainClassConstructors = array());

    /**
     * Defines an alias class for all occurrences of a given typehint
     *
     * Use this method to specify implementation classes for interface and abstract class typehints.
     *
     * @param string $originalTypehint The typehint to replace
     * @param string $aliasClassName The implementation class name
     * @param array $chainClassConstructors
     * @return
     */
    public function alias($originalTypehint, $aliasClassName, array $chainClassConstructors = array());

    /**
     * Delegates the creation of $className instances to $callable
     *
     * @param string $className
     * @param callable $callable
     * @param array $args
     * @param array $chainClassConstructors
     * @return
     */
    public function delegate($className, $callable, array $args = array(), array $chainClassConstructors = array());

    /**
     * Register a mutator callable to modify (prepare) objects after instantiation
     *
     * Any callable or provisionable executable may be specified. Preparers are passed two
     * arguments: the instantiated object to be modified and the current Injector instance.
     *
     * @param string $classInterfaceOrTraitName
     * @param mixed $executable Any callable or provisionable executable method
     * @param array $chainClassConstructors
     * @return
     */
    public function prepare($classInterfaceOrTraitName, $executable, array $chainClassConstructors = array());


    /**
     * Shares the specified class across the Injector context
     *
     * @param mixed $classNameOrInstance The class or object to share
     * @param array $chainClassConstructors
     * @return
     */
    public function share($classNameOrInstance, array $chainClassConstructors = array());



    
    /**
     * Unshares the specified class or the class of the specified instance
     *
     * @param string $classNameOrInstance The class or object to unshare
     */
    public function unshare($classNameOrInstance);

    /**
     * Forces re-instantiation of a shared class the next time it is requested
     *
     * @param string $className The class name for which an existing share should be cleared for re-instantiation
     */
    public function refresh($className);

}