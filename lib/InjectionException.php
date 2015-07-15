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
