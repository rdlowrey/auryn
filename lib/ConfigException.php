<?php

namespace Auryn;

class ConfigException extends InjectorException
{
    /**
     * Add a human readable version of the invalid callable to the standard 'invalid invokable' message.
     */
    public static function fromInvalidCallable(
        $callableOrMethodStr,
        \Exception $previous = null
    ) {

        $message = InjectionException::getInvalidCallableMessage(
            $callableOrMethodStr
        );

        return new self($message, Injector::E_INVOKABLE, $previous);
    }

}
