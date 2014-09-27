<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
    'line' => 4,
    'char' => 9,
  ),
  1 => 
  array (
    'type' => 'interface',
    'name' => 'ReflectorInterface',
    'definition' => 
    array (
      'methods' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getClass',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'className',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 12,
              'char' => 47,
            ),
          ),
          'docblock' => '**
     * Retrieves ReflectionClass instances, caching them for future retrieval
     *
     * @param string className
     * @return \\ReflectionClass
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'cast' => 
                array (
                  'type' => 'variable',
                  'value' => '\\ReflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                  'line' => 12,
                  'char' => 70,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 12,
                'char' => 70,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
            'line' => 12,
            'char' => 70,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
          'line' => 19,
          'char' => 6,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getCtor',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'className',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 20,
              'char' => 46,
            ),
          ),
          'docblock' => '**
     * Retrieves and caches the constructor (ReflectionMethod) for the specified class
     *
     * @param string className
     * @return \\ReflectionMethod
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'cast' => 
                array (
                  'type' => 'variable',
                  'value' => '\\ReflectionMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                  'line' => 20,
                  'char' => 70,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 20,
                'char' => 70,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
            'line' => 20,
            'char' => 70,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
          'line' => 27,
          'char' => 6,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getCtorParams',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'className',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 28,
              'char' => 52,
            ),
          ),
          'docblock' => '**
     * Retrieves and caches an array of constructor parameters for the given class
     *
     * @param string className
     * @return array[\\ReflectionParameter]
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'data-type' => 'array',
                'mandatory' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 28,
                'char' => 62,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
            'line' => 28,
            'char' => 62,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
          'line' => 41,
          'char' => 6,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getParamTypeHint',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'function',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => '\\ReflectionFunctionAbstract',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 42,
                'char' => 75,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 42,
              'char' => 76,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'param',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => '\\ReflectionParameter',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 42,
                'char' => 105,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 42,
              'char' => 106,
            ),
          ),
          'docblock' => '**
     * Retrieves the class type-hint from a given ReflectionParameter
     *
     * There is no way to directly access a parameter\'s type-hint without
     * instantiating a new ReflectionClass instance and calling its getName()
     * method. This method stores the results of this approach so that if
     * the same parameter type-hint or ReflectionClass is needed again we
     * already have it cached.
     *
     * @param \\ReflectionFunctionAbstract $function
     * @param \\ReflectionParameter param
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'cast' => 
                array (
                  'type' => 'variable',
                  'value' => '\\ReflectionParameter',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                  'line' => 42,
                  'char' => 133,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 42,
                'char' => 133,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
            'line' => 42,
            'char' => 133,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
          'line' => 49,
          'char' => 6,
        ),
        4 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getFunction',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'functionName',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 50,
              'char' => 53,
            ),
          ),
          'docblock' => '**
     * Retrieves and caches a reflection for the specified function
     *
     * @param string functionName
     * @return \\ReflectionFunction
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'cast' => 
                array (
                  'type' => 'variable',
                  'value' => '\\ReflectionFunction',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                  'line' => 50,
                  'char' => 79,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 50,
                'char' => 79,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
            'line' => 50,
            'char' => 79,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
          'line' => 58,
          'char' => 6,
        ),
        5 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getMethod',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'classNameOrInstance',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 59,
              'char' => 54,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'methodName',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
              'line' => 59,
              'char' => 74,
            ),
          ),
          'docblock' => '**
     * Retrieves and caches a reflection for the specified class method
     *
     * @param mixed classNameOrInstance
     * @param string methodName
     * @return \\ReflectionMethod
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'cast' => 
                array (
                  'type' => 'variable',
                  'value' => '\\ReflectionMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                  'line' => 59,
                  'char' => 98,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
                'line' => 59,
                'char' => 98,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
            'line' => 59,
            'char' => 98,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
          'line' => 60,
          'char' => 1,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
      'line' => 60,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/reflectorinterface.zep',
    'line' => 61,
    'char' => 0,
  ),
);