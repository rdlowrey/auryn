<?php

namespace Auryn\Plugin;

interface ProviderInjectionPlugin extends ProviderPlugin {

    public function normalizeClassName($className);
    public function getInterfacePrepares($interfacesImplemented);
    public function resolveAlias($className);
    public function getShared($normalizedClass);
    public function isDelegated($className);
    public function getParamDefine($paramName);
    public function isParamDefined($paramName);
    public function getDefinition($className);
    public function getDelegated($className);
    public function shareIfNeeded($normalizedClass, $provisionedObject);
    public function getPrepareDefine($classInterfaceOrTraitName);
}
 