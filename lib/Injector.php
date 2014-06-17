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
    public function make($className, array $customDefinition = NULL);

    /**
     * Invoke the specified callable or class/method combo, provisioning any needed dependencies along the way.
     *
     * @param mixed $executable Any valid PHP callable or a provisionable ClassName::methodName string
     * @param array $invocationArgs An optional array specifying params to invoke the provisioned callable
     * @param bool $makeAccessible If TRUE, protected/private methods will execute successfully
     */
    public function execute($executable, array $invocationArgs = array(), $makeAccessible = FALSE);

    /**
     * Generate and provision an executable from any PHP callable or class/method string array
     *
     * @param mixed $executable Any valid PHP callable or a provisionable ClassName::methodName string
     * @param bool $makeAccessible If TRUE, protected/private methods will execute successfully
     */
    public function buildExecutable($executable, $makeAccessible = FALSE);
}
