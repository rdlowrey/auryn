<?php

namespace Auryn;

class InjectionException extends InjectorException
{
    public $dependencyChain;
    
    public function __construct(array $inProgressMakes, $message = "", $code = 0, \Exception $previous = null)
    {
        $this->dependencyChain = array_flip($inProgressMakes);
        ksort($this->dependencyChain);
        
        parent::__construct($message, $code, $previous);
    }

    public static function fromInvalidDefineParamsNotArray($definition, array $inProgressMakes): self
    {
        $message = sprintf(
            Injector::M_INVALID_DEFINE_ARGUMENT_NOT_ARRAY,
            gettype($definition)
        );

        return new self(
            $inProgressMakes,
            $message,
            Injector::E_INVALID_DEFINE_ARGUMENT_NOT_ARRAY
        );
    }

    public static function fromInvalidDefineParamsBadKeys($definition, array $inProgressMakes)
    {
        $missingKeys = [];
        if (!isset($definition[0])) {
            $missingKeys[] = "array key 0 not set";
        }
        if (!isset($definition[1])) {
            $missingKeys[] = "array key 1 not set";
        }

        $message = sprintf(
            Injector::M_INVALID_DEFINE_ARGUMENT_BAD_KEYS,
            implode(" ", $missingKeys)
        );

        return new self(
            $inProgressMakes,
            $message,
            Injector::E_INVALID_DEFINE_ARGUMENT_BAD_KEYS
        );
    }

    public static function contextError($dependencyChain, $message, $code, \Exception $previous)
    {
        $instance = new self([]);
        $instance->__construct($message, $code, $previous);
        $instance->dependencyChain = $dependencyChain;
        return $instance;
    }

    /**
     * If PHP had package based privacy rules, this could be package private
     * or this could be 'just' a function.
     * @param $callableOrMethodStr
     * @return string
     */
    public static function getInvalidCallableMessage($callableOrMethodStr)
    {
        $callableString = null;

        if (is_string($callableOrMethodStr)) {
            $callableString .= $callableOrMethodStr;
        } elseif (is_array($callableOrMethodStr) &&
            array_key_exists(0, $callableOrMethodStr)) {
            if (is_string($callableOrMethodStr[0]) && is_string($callableOrMethodStr[1])) {
                $callableString .= $callableOrMethodStr[0].'::'.$callableOrMethodStr[1];
            } elseif (is_object($callableOrMethodStr[0]) && is_string($callableOrMethodStr[1])) {
                $callableString .= sprintf(
                    "[object(%s), '%s']",
                    get_class($callableOrMethodStr[0]),
                    $callableOrMethodStr[1]
                );
            }
        }

        if ($callableString) {
            // Prevent accidental usage of long strings from filling logs.
            $callableString = substr($callableString, 0, 250);
            return sprintf(
                "%s. Invalid callable was '%s'",
                Injector::M_INVOKABLE,
                $callableString
            );
        }

        return Injector::M_INVOKABLE;
    }

    /**
     * Add a human readable version of the invalid callable to the standard 'invalid invokable' message.
     */
    public static function fromInvalidCallable(
        array $inProgressMakes,
        $callableOrMethodStr,
        \Exception $previous = null
    ) {
        $message = self::getInvalidCallableMessage(
            $callableOrMethodStr
        );

        return new self($inProgressMakes, $message, Injector::E_INVOKABLE, $previous);
    }

    /**
     * Returns the hierarchy of dependencies that were being created when
     * the exception occurred.
     * @return array
     */
    public function getDependencyChain()
    {
        return $this->dependencyChain;
    }
}
