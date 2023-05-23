<?php



class Dependency {}

class NullableDependency
{
    public ?Dependency $instance;

    public function __construct(?Dependency $instance = null)
    {
        $this->instance = $instance;
    }
}

class UnionNullDependency
{
    public ?Dependency $instance;

    public function __construct(?Dependency $instance = null)
    {
        $this->instance = $instance;
    }
}



class DefaultNullDependency
{
    public ?Dependency $instance;

    public function __construct(Dependency $instance = null)
    {
        $this->instance = $instance;
    }
}