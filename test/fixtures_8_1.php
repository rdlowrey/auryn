<?php

class NewInInitializerDependency {}

class NewInInitializer
{
    public function __construct(public NewInInitializerDependency $instance = new NewInInitializerDependency)
    {
        $this->instance = $instance;
    }
}





