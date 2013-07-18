<?php

namespace Auryn;

class InjectorBuilder {
    
    /**
     * @var array
     */
    private static $configKeys = array(
        'aliases' => 1,
        'definitions' => 1,
        'shares' => 1,
        'delegates' => 1
    );
    
    /**
     * Populate a Provider instance using the specified configuration file
     * 
     * @param string $filePath The path to a PHP or JSON file holding the Provider configuration
     * @param Provider $provider An optional Provider instance; if not specified one will be created
     * @param string $fileType Used to determine config file type in place of the file's extension if specified
     * @throws BuilderException On bad configuration value(s)
     * @return Provider Returns the populated Provider instance
     */
    public function fromFile($filePath, Provider $provider = NULL, $fileType = NULL) {
        $provider = $provider ?: new Provider;
        $extension = isset($fileType) ? ltrim($fileType, '.') : pathinfo($filePath, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        
        switch ($extension) {
            case 'php':
                $this->loadFromPhpFile($provider, $filePath);
                break;
            case 'json':
                $this->loadFromJsonFile($provider, $filePath);
                break;
            default:
                throw new BuilderException(
                    'Unknown configuration file type; must end in .php, .json or specify the file type ' .
                    'using the optional $fileType parameter at Argument 3'
                );
        }
        
        return $provider;
    }
    
    private function loadFromPhpFile(Provider $provider, $filePath) {
        if (!@include $filePath) {
            throw new BuilderException(
                "Failed including the specified PHP configuration file: {$filePath}"
            );
        } elseif (!(isset($aurynConfig) && is_array($aurynConfig))) {
            throw new BuilderException(
                'PHP configuration file must specify an array named $aurynConfig'
            );
        } else {
            $this->fromArray($aurynConfig, $provider);
        }
    }
    
    private function loadFromJsonFile(Provider $provider, $filePath) {
        $rawJson = @file_get_contents($filePath);
        
        if ($rawJson === FALSE) {
            throw new BuilderException(
                "Failed reading the specified JSON configuration file: {$filePath}"
            );
        }
        
        $jsonConfigurationArray = @json_decode($rawJson, TRUE);
        
        if (isset($jsonConfigurationArray)) {
            $this->fromArray($jsonConfigurationArray, $provider);
        } else {
            throw new BuilderException(
                "Failed parsing JSON configuration from the specified file: {$filePath}"
            );
        }
    }
    
    /**
     * Populate a Provider instance using the specified configuration array
     * 
     * @param array $configuration An array describing how to populate the Provider instance
     * @param Provider $provider An optional Provider instance; if not specified one will be created
     * @throws BuilderException On bad configuration value(s)
     * @return Provider Returns the populated Provider instance
     */
    public function fromArray(array $configuration, Provider $provider = NULL) {
        $invalidKeys = array_diff_key($configuration, self::$configKeys);
        
        if ($invalidKeys) {
            throw new BuilderException(
                'Invalid configuration keys: ['. implode(', ', array_keys($invalidKeys)) .
                '] -- did you forget to add a new configuration type handler to fromArray()?'
            );
        } else {
            $provider = $provider ?: new Provider;
            
            foreach ($configuration as $configurationType => $configurationValues) {
                $assignmentMethod = 'add' . ucfirst($configurationType);
                $this->$assignmentMethod($provider, $configurationValues);
            }
        }
        
        return $provider;
    }

    private function addAliases(Provider $provider, $configurationValues) {
        try {
            foreach ($configurationValues as $typeHintToReplace => $alias) {
                $provider->alias($typeHintToReplace, $alias);
            }
        } catch (BadArgumentException $error) {
            throw new BuilderException(
                'Invalid alias specified in configuration array',
                0, $error
            );
        }
    }

    private function addDefinitions(Provider $provider, $configurationValues) {
        try {
            foreach ($configurationValues as $className => $definition) {
                $provider->define($className, $definition);
            }
        } catch (BadArgumentException $error) {
            throw new BuilderException(
                'Invalid definition specified in configuration array',
                0, $error
            );
        }
    }

    private function addShares(Provider $provider, $configurationValues) {
        try {
            foreach ($configurationValues as $share) {
                $provider->share($share);
            }
        } catch (BadArgumentException $error) {
            throw new BuilderException(
                'Invalid share specified in configuration array',
                0, $error
            );
        }
    }

    private function addDelegates(Provider $provider, $configurationValues) {
        try {
            foreach ($configurationValues as $className => $delegate) {
                $provider->delegate($className, $delegate);
            }
        } catch (BadArgumentException $error) {
            throw new BuilderException(
                'Invalid delegate specified in configuration array',
                0, $error
            );
        }
    }

}
