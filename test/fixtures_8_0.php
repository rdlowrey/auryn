<?php

class TestInstance {

}

class InjectorTestNullableParams
{
  public ?TestInstance $string;

  public function __construct(?TestInstance $instance)
  {
    $this->instance = $instance;
  }
}