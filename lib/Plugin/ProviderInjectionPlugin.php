<?php

namespace Auryn\Plugin;

interface ProviderInjectionPlugin {

    public function normalizeClassName($className);
    public function getInterfacePrepares($interfacesImplemented);
    public function resolveAlias($className, array $classConstructorChain);
    public function getShared($normalizedClass, array $classConstructorChain);
    public function isDelegated($className, array $classConstructorChain);
    public function getParamDefine($paramName, array $classConstructorChain);
    public function isParamDefined($paramName, array $classConstructorChain);
    public function getDefinition($className, array $classConstructorChain);
    public function getDelegated($className, array $classConstructorChain);
    public function shareIfNeeded($normalizedClass, $provisionedObject, array $classConstructorChain);
    public function getPrepareDefine($classInterfaceOrTraitName, array $classConstructorChain);
}
 