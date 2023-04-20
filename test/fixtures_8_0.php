<?php



class Dependency {}

class NullableDependency
{
    public ?Dependency $string;

    public function __construct(?Dependency $instance = null)
    {
        $this->instance = $instance;
    }
}

class UnionNullDependency
{
    public ?Dependency $string;

    public function __construct(?Dependency $instance = null)
    {
        $this->instance = $instance;
    }
}



class DefaultNullDependency
{
    public ?Dependency $string;

    public function __construct(Dependency $instance = null)
    {
        $this->instance = $instance;
    }
}