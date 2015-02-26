<?php




namespace Auryn;

/**
 * The Provider exposes functionality for defining context-wide instantiation, instance sharing,
 * implementation and delegation rules for injecting and automatically provisioning deeply nested
 * class dependencies.
 */

class Provider implements Injector {

    /**
     * @var AurynInjector
     */
    private $injector;

    /**
     * @var Plugin\ProviderPlugin
     */
    private $plugin;
    
    public function __construct(ReflectionStorage $reflectionStorage = NULL) {
        $this->plugin = new Plugin\StandardProviderPlugin();
        $this->injector = new AurynInjector($this->plugin, $reflectionStorage);
    }

    public function make($className, array $customDefinition = []) {
        return $this->injector->make($className, $customDefinition);
    }
    
    public function execute($callableOrMethodArr, array $invocationArgs = array(), $makeAccessible = FALSE) {
        return $this->injector->execute($callableOrMethodArr, $invocationArgs, $makeAccessible);
    }

    public function buildExecutable($callableOrMethodArr, $makeAccessible = FALSE) {
        return $this->injector->buildExecutable($callableOrMethodArr, $makeAccessible);
    }


    public function define($className, array $injectionDefinition) {
        $this->plugin->define($className, $injectionDefinition);
        
        return $this;
    }

    public function defineParam($paramName, $value) {
        $this->plugin->defineParam($paramName, $value);
        
        return $this;
    }

    public function alias($originalTypehint, $aliasClassName) {
        $this->plugin->alias($originalTypehint, $aliasClassName);

        return $this;
    }

    public function delegate($className, $callable, array $args = array()) {

        $this->plugin->delegate($className, $callable, $args);
        
        return $this;
    }

    public function delegateParam($className, $callable, array $args = array()) {
        $this->plugin->delegateParam($className, $callable, [], $args);

        return $this;
    }
    

    public function prepare($classInterfaceOrTraitName, $executable) {
        $this->plugin->prepare($classInterfaceOrTraitName, $executable);
        
        return $this;
    }

    public function share($classNameOrInstance) {
        $this->plugin->share($classNameOrInstance);

        return $this;
    }

    public function unshare($classNameOrInstance) {
        $this->plugin->unshare($classNameOrInstance);

        return $this;
    }

    public function refresh($className) {
        $this->plugin->refresh($className);

        return $this;
    }
}
