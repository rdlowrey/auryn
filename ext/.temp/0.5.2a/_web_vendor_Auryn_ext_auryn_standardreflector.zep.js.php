<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'StandardReflector',
    'abstract' => 0,
    'final' => 0,
    'implements' => 
    array (
      0 => 
      array (
        'type' => 'variable',
        'value' => 'ReflectorInterface',
        'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
        'line' => 5,
        'char' => 1,
      ),
    ),
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
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 9,
              'char' => 47,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'new',
                'class' => '\\ReflectionClass',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'className',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 11,
                      'char' => 46,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 11,
                    'char' => 46,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 11,
                'char' => 47,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 12,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
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
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 10,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 10,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
            'line' => 10,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
          'line' => 16,
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
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 17,
              'char' => 46,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'declare',
              'data-type' => 'variable',
              'variables' => 
              array (
                0 => 
                array (
                  'variable' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 19,
                  'char' => 28,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 20,
              'char' => 11,
            ),
            1 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'reflectionClass',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => '\\ReflectionClass',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'className',
                          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                          'line' => 20,
                          'char' => 61,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                        'line' => 20,
                        'char' => 61,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 20,
                    'char' => 62,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 20,
                  'char' => 62,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 21,
              'char' => 14,
            ),
            2 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'mcall',
                'variable' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 21,
                  'char' => 32,
                ),
                'name' => 'getCtor',
                'call-type' => 3,
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 21,
                'char' => 46,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 22,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
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
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 18,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 18,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
            'line' => 18,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
          'line' => 26,
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
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 27,
              'char' => 52,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'declare',
              'data-type' => 'variable',
              'variables' => 
              array (
                0 => 
                array (
                  'variable' => 'reflectedCtor',
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 29,
                  'char' => 26,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 30,
              'char' => 11,
            ),
            1 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'reflectedCtor',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 30,
                      'char' => 34,
                    ),
                    'name' => 'getCtor',
                    'call-type' => 3,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'className',
                          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                          'line' => 30,
                          'char' => 56,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                        'line' => 30,
                        'char' => 56,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 30,
                    'char' => 57,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 30,
                  'char' => 57,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 31,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectedCtor',
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 31,
                'char' => 26,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'reflectedCtor',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 32,
                      'char' => 34,
                    ),
                    'name' => 'getParameters',
                    'call-type' => 1,
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 32,
                    'char' => 50,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 33,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 34,
              'char' => 13,
            ),
            3 => 
            array (
              'type' => 'throw',
              'expr' => 
              array (
                'type' => 'new',
                'class' => 'Exception',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'string',
                      'value' => 'Could not load reflectedCtor',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 34,
                      'char' => 59,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 34,
                    'char' => 59,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 34,
                'char' => 60,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 35,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
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
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 28,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
            'line' => 28,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
          'line' => 39,
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
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 40,
                'char' => 75,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 40,
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
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 40,
                'char' => 105,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 40,
              'char' => 106,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'declare',
              'data-type' => 'variable',
              'variables' => 
              array (
                0 => 
                array (
                  'variable' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 42,
                  'char' => 28,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 43,
              'char' => 11,
            ),
            1 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'reflectionClass',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'param',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 43,
                      'char' => 37,
                    ),
                    'name' => 'getClass',
                    'call-type' => 1,
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 43,
                    'char' => 48,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 43,
                  'char' => 48,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 44,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectionClass',
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 44,
                'char' => 28,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'reflectionClass',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 45,
                      'char' => 36,
                    ),
                    'name' => 'getName',
                    'call-type' => 1,
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 45,
                    'char' => 46,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 46,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 47,
              'char' => 13,
            ),
            3 => 
            array (
              'type' => 'throw',
              'expr' => 
              array (
                'type' => 'new',
                'class' => 'Exception',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'string',
                      'value' => 'Could not load reflection class',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 47,
                      'char' => 62,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 47,
                    'char' => 62,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 47,
                'char' => 63,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 48,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
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
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 41,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 41,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
            'line' => 41,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
          'line' => 52,
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
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 53,
              'char' => 53,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'new',
                'class' => '\\ReflectionFunction',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'functionName',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 55,
                      'char' => 52,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 55,
                    'char' => 52,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 55,
                'char' => 53,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 56,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
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
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 54,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 54,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
            'line' => 54,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
          'line' => 60,
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
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 61,
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
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 61,
              'char' => 74,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'equals',
                'left' => 
                array (
                  'type' => 'typeof',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'classNameOrInstance',
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 63,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 63,
                  'char' => 40,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'string',
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 63,
                  'char' => 51,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 63,
                'char' => 51,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => '\\ReflectionMethod',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'classNameOrInstance',
                          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                          'line' => 64,
                          'char' => 61,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                        'line' => 64,
                        'char' => 61,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'methodName',
                          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                          'line' => 64,
                          'char' => 73,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                        'line' => 64,
                        'char' => 73,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 64,
                    'char' => 74,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 65,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 66,
              'char' => 14,
            ),
            1 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'new',
                'class' => '\\ReflectionMethod',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'get_class',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'variable',
                            'value' => 'classNameOrInstance',
                            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                            'line' => 66,
                            'char' => 67,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                          'line' => 66,
                          'char' => 67,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 66,
                      'char' => 68,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 66,
                    'char' => 68,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'methodName',
                      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                      'line' => 66,
                      'char' => 80,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                    'line' => 66,
                    'char' => 80,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 66,
                'char' => 81,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
              'line' => 67,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
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
                  'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                  'line' => 62,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
                'line' => 62,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
            'line' => 62,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
          'line' => 68,
          'char' => 1,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
      'line' => 68,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/standardreflector.zep',
    'line' => 69,
    'char' => 0,
  ),
);