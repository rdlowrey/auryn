<?php

namespace Auryn\Plugin;

interface ProviderInjectionPlugin {

    public function normalizeClassName($className);
    public function getInterfacePrepares($interfacesImplemented);
    public function resolveAlias($className, array $chainClassConstructors);
    public function getShared($normalizedClass, array $chainClassConstructors);
    public function isDelegated($normalizedClass, array $chainClassConstructors);
    public function getParamDefine($paramName, array $chainClassConstructors);
    public function isParamDefined($paramName, array $chainClassConstructors);
    public function getDefinition($className, array $chainClassConstructors);
    public function getDelegated($className, array $chainClassConstructors);
    public function getParamDelegation($paramName, array $classConstructorChain);
    public function shareIfNeeded($normalizedClass, $provisionedObject, array $chainClassConstructors);
    public function getPrepareDefine($classInterfaceOrTraitName, array $chainClassConstructors);
}
 