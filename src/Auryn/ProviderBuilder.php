<?php

namespace Auryn;

class ProviderBuilder {

    public function fromArray(Provider $provider, array $configuration) {
        $this->validateConfiguration($configuration);

        foreach ($configuration as $configurationType => $configurationValues) {
            switch ($configurationType) {
                case 'aliases':
                    $this->addAliases($provider, $configurationValues);
                    break;
                case 'definitions':
                    $this->addDefinitions($provider, $configurationValues);
                    break;
                case 'shares':
                    $this->addShares($provider, $configurationValues);
                    break;
                case 'delegates':
                    $this->addDelegates($provider, $configurationValues);
                    break;
                default:
                    throw new \InvalidArgumentException("Invalid configuration key: {$configurationType} - did you forget to add a new configuration type handler to fromArray()?");
                    break;
            }
        }
    }

    /**
     * @param array $configuration
     * @throws \InvalidArgumentException
     */
    private function validateConfiguration(array $configuration)
    {
        foreach (array_keys($configuration) as $key) {
            if ( ! in_array($key, array(
                'aliases',
                'definitions',
                'shares',
                'delegates'
            ))) {
                throw new \InvalidArgumentException("Invalid configuration key: {$key}");
            }
        }
    }

    /**
     * @param Provider $provider
     * @param $configurationValues
     */
    private function addAliases(Provider $provider, $configurationValues)
    {
        foreach ($configurationValues as $typeHintToReplace => $alias) {
            $provider->alias($typeHintToReplace, $alias);
        }
    }

    /**
     * @param Provider $provider
     * @param $configurationValues
     */
    private function addDefinitions(Provider $provider, $configurationValues)
    {
        foreach ($configurationValues as $className => $definition) {
            $provider->define($className, $definition);
        }
    }

    /**
     * @param Provider $provider
     * @param $configurationValues
     */
    private function addShares(Provider $provider, $configurationValues)
    {
        foreach ($configurationValues as $share) {
            $provider->share($share);
        }
    }

    /**
     * @param Provider $provider
     * @param $configurationValues
     */
    private function addDelegates(Provider $provider, $configurationValues)
    {
        foreach ($configurationValues as $className => $delegate) {
            $provider->delegate($className, $delegate);
        }
    }

}
