<?php

namespace Auryn;

class InjectorBuilder {
    const E_INVALID_CONFIG_OPTION = 0;
    const E_INVALID_ALIAS = 1;
    const E_INVALID_DEFINE = 2;
    const E_INVALID_SHARE = 3;
    const E_INVALID_DELEGATE = 4;
    const E_UNKNOWN_FILE_TYPE = 5;
    const E_FAILED_INCLUDE = 6;
    const E_FAILED_PARSING = 7;

    private $errorMessages = array(
        self::E_INVALID_CONFIG_OPTION => 'Unknown configuration option: %s',
        self::E_INVALID_ALIAS => 'Invalid alias specified in configuration array',
        self::E_INVALID_DEFINE => 'Invalid definition specified in configuration array',
        self::E_INVALID_SHARE => 'Invalid share specified in configuration array',
        self::E_INVALID_DELEGATE => 'Invalid delegate specified in configuration array',
        self::E_UNKNOWN_FILE_TYPE => 'Unknown configuration file type; must end in .php, .json or specify the file type using the optional $fileType parameter at Argument 3',
        self::E_FAILED_INCLUDE => 'Failed including the specified % configuration file: %',
        self::E_FAILED_PARSING => 'Failed parsing %s configuration from the specified file: %s'
    );

    /**
     * Populate a Provider instance using the specified configuration file
     *
     * @param string $filePath The path to a PHP or JSON file holding the Provider configuration
     * @param \Auryn\Provider $provider An optional Provider instance; if not specified one will be created
     * @param string $fileType Used to determine config file type in place of the file's extension if specified
     * @throws \Auryn\BuilderException On bad configuration value(s)
     * @return \Auryn\Provider Returns the populated Provider instance
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
                    $this->errorMessages[self::E_UNKNOWN_FILE_TYPE],
                    self::E_UNKNOWN_FILE_TYPE
                );
        }

        return $provider;
    }

    private function loadFromPhpFile(Provider $provider, $filePath) {
        if (!@include $filePath) {
            throw new BuilderException(
                sprintf($this->errorMessages[self::E_FAILED_INCLUDE], 'PHP', $filePath),
                self::E_FAILED_INCLUDE
            );
        } elseif (!(isset($aurynConfig) && is_array($aurynConfig))) {
            $message ='must specify an array named $aurynConfig';
            throw new BuilderException(
                sprintf($this->errorMessages[self::E_FAILED_PARSING], 'PHP', $message),
                self::E_FAILED_PARSING
            );
        } else {
            $this->fromArray($aurynConfig, $provider);
        }
    }

    private function loadFromJsonFile(Provider $provider, $filePath) {
        $rawJson = @file_get_contents($filePath);

        if ($rawJson === FALSE) {
            throw new BuilderException(
                sprintf($this->errorMessages[self::E_FAILED_INCLUDE], 'JSON', $filePath),
                self::E_FAILED_INCLUDE
            );
        }

        $jsonConfigurationArray = @json_decode($rawJson, TRUE);

        if (isset($jsonConfigurationArray)) {
            $this->fromArray($jsonConfigurationArray, $provider);
        } else {
            throw new BuilderException(
                sprintf($this->errorMessages[self::E_FAILED_PARSING], 'JSON', $filePath),
                self::E_FAILED_PARSING
            );
        }
    }

    /**
     * Populate a Provider instance using the specified configuration array
     *
     * @param array $configuration An array describing how to populate the Provider instance
     * @param \Auryn\Provider $provider An optional Provider instance; if not specified one will be created
     * @throws \Auryn\BuilderException
     * @throws \Auryn\BadArgumentException
     * @return \Auryn\Provider Returns the populated Provider instance
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
                        sprintf($this->errorMessages[self::E_INVALID_CONFIG_OPTION], $configurationType),
                        self::E_INVALID_CONFIG_OPTION
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
                $this->errorMessages[self::E_INVALID_ALIAS],
                self::E_INVALID_ALIAS,
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
                $this->errorMessages[self::E_INVALID_DEFINE],
                self::E_INVALID_DEFINE,
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
                $this->errorMessages[self::E_INVALID_SHARE],
                self::E_INVALID_SHARE,
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
                $this->errorMessages[self::E_INVALID_DELEGATE],
                self::E_INVALID_DELEGATE,
                $error
            );
        }
    }
}
