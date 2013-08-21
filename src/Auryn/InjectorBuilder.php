<?php

namespace Auryn;

class InjectorBuilder {

    const E_INVALID_CONFIG_OPTION_CODE = 0;
    const E_INVALID_CONFIG_OPTION_MESSAGE = 'Unknown configuration option: %s';

    const E_INVALID_ALIAS_CODE = 1;
    const E_INVALID_ALIAS_MESSAGE = 'Invalid alias specified in configuration array';

    const E_INVALID_DEFINE_CODE = 2;
    const E_INVALID_DEFINE_MESSAGE = 'Invalid definition specified in configuration array';

    const E_INVALID_SHARE_CODE = 3;
    const E_INVALID_SHARE_MESSAGE = 'Invalid share specified in configuration array';

    const E_INVALID_DELEGATE_CODE = 4;
    const E_INVALID_DELEGATE_MESSAGE = 'Invalid delegate specified in configuration array';

    const E_UNKNOWN_FILE_TYPE_CODE = 5;
    const E_UNKNOWN_FILE_TYPE_MESSAGE = 'Unknown configuration file type; must end in .php, .json or specify the file type using the optional $fileType parameter at Argument 3';

    const E_FAILED_INCLUDE_CODE = 6;
    const E_FAILED_INCLUDE_MESSAGE = 'Failed including the specified % configuration file: %';

    const E_FAILED_PARSING_CODE = 7;
    const E_FAILED_PARSING_MESSAGE = 'Failed parsing %s configuration from the specified file: %s';

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
                    self::E_UNKNOWN_FILE_TYPE_MESSAGE,
                    self::E_UNKNOWN_FILE_TYPE_CODE
                );
        }
        
        return $provider;
    }
    
    private function loadFromPhpFile(Provider $provider, $filePath) {
        if (!@include $filePath) {
            throw new BuilderException(
                sprintf(self::E_FAILED_INCLUDE_MESSAGE, 'PHP', $filePath),
                self::E_FAILED_INCLUDE_CODE
            );
        } elseif (!(isset($aurynConfig) && is_array($aurynConfig))) {
            $message ='must specify an array named $aurynConfig';
            throw new BuilderException(
                sprintf(self::E_FAILED_PARSING_MESSAGE, 'PHP', $message),
                self::E_FAILED_PARSING_CODE
            );
        } else {
            $this->fromArray($aurynConfig, $provider);
        }
    }
    
    private function loadFromJsonFile(Provider $provider, $filePath) {
        $rawJson = @file_get_contents($filePath);
        
        if ($rawJson === FALSE) {
            throw new BuilderException(
                sprintf(self::E_FAILED_INCLUDE_MESSAGE, 'JSON', $filePath),
                self::E_FAILED_INCLUDE_CODE
            );
        }
        
        $jsonConfigurationArray = @json_decode($rawJson, TRUE);
        
        if (isset($jsonConfigurationArray)) {
            $this->fromArray($jsonConfigurationArray, $provider);
        } else {
            throw new BuilderException(
                sprintf(self::E_FAILED_PARSING_MESSAGE, 'JSON', $filePath),
                self::E_FAILED_PARSING_CODE
            );
        }
    }

    /**
     * Populate a Provider instance using the specified configuration array
     *
     * @param array $configuration An array describing how to populate the Provider instance
     * @param Provider $provider An optional Provider instance; if not specified one will be created
     * @throws BuilderException
     * @throws BadArgumentException
     * @return Provider Returns the populated Provider instance
     */
    public function fromArray(array $configuration, Provider $provider = NULL) {
        $provider = $provider ?: new Provider;

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
                    throw new BuilderException(
                        sprintf(self::E_INVALID_CONFIG_OPTION_MESSAGE, $configurationType),
                        self::E_INVALID_CONFIG_OPTION_CODE
                    );
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
                self::E_INVALID_ALIAS_MESSAGE,
                self::E_INVALID_ALIAS_CODE,
                $error
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
                self::E_INVALID_DEFINE_MESSAGE,
                self::E_INVALID_DEFINE_CODE,
                $error
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
                self::E_INVALID_SHARE_MESSAGE,
                self::E_INVALID_SHARE_CODE,
                $error
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
                self::E_INVALID_DELEGATE_MESSAGE,
                self::E_INVALID_DELEGATE_CODE,
                $error
            );
        }
    }

}
