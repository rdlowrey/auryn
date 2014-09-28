<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'CachingReflector',
    'abstract' => 0,
    'final' => 0,
    'implements' => 
    array (
      0 => 
      array (
        'type' => 'variable',
        'value' => 'ReflectorInterface',
        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
        'line' => 5,
        'char' => 1,
      ),
    ),
    'definition' => 
    array (
      'properties' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'reflector',
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 13,
          'char' => 13,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'cache',
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 15,
          'char' => 10,
        ),
      ),
      'methods' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => '__construct',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'reflector',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => 'ReflectorInterface',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 15,
                'char' => 62,
              ),
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 15,
                'char' => 70,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 15,
              'char' => 70,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'cache',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => 'ReflectionCacheInterface',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 15,
                'char' => 103,
              ),
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 15,
                'char' => 111,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 15,
              'char' => 111,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'unlikely',
                'left' => 
                array (
                  'type' => 'equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'reflector',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 17,
                      'char' => 39,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 17,
                    'char' => 39,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'null',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 17,
                    'char' => 48,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 17,
                  'char' => 48,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 17,
                'char' => 48,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'reflector',
                      'expr' => 
                      array (
                        'type' => 'new',
                        'class' => 'StandardReflector',
                        'dynamic' => 0,
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 18,
                        'char' => 56,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 18,
                      'char' => 56,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 19,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'reflector',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'reflector',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 20,
                        'char' => 44,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 20,
                      'char' => 44,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 21,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 23,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'unlikely',
                'left' => 
                array (
                  'type' => 'equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'cache',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 23,
                      'char' => 35,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 23,
                    'char' => 35,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'null',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 23,
                    'char' => 44,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 23,
                  'char' => 44,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 23,
                'char' => 44,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'cache',
                      'expr' => 
                      array (
                        'type' => 'new',
                        'class' => 'ReflectionCacheArray',
                        'dynamic' => 0,
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 24,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 24,
                      'char' => 55,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 25,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'cache',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 26,
                        'char' => 36,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 26,
                      'char' => 36,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 27,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 28,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 30,
          'char' => 10,
        ),
        1 => 
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
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 30,
              'char' => 47,
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
                  'variable' => 'cacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 32,
                  'char' => 21,
                ),
                1 => 
                array (
                  'variable' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 32,
                  'char' => 38,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 34,
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
                  'variable' => 'cacheKey',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 34,
                        'char' => 48,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'CACHE_KEY_CLASSES',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 34,
                        'char' => 48,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 34,
                      'char' => 48,
                    ),
                    'right' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'strtolower',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'variable',
                            'value' => 'className',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 34,
                            'char' => 70,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 34,
                          'char' => 70,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 34,
                      'char' => 71,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 34,
                    'char' => 71,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 34,
                  'char' => 71,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 35,
              'char' => 11,
            ),
            2 => 
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
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 35,
                        'char' => 36,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 35,
                        'char' => 43,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 35,
                      'char' => 43,
                    ),
                    'name' => 'fetch',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 35,
                          'char' => 58,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 35,
                        'char' => 58,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 35,
                    'char' => 59,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 35,
                  'char' => 59,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 37,
              'char' => 10,
            ),
            3 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 37,
                  'char' => 29,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 37,
                'char' => 29,
              ),
              'statements' => 
              array (
                0 => 
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
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 38,
                              'char' => 65,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 38,
                            'char' => 65,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 38,
                        'char' => 66,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 38,
                      'char' => 66,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 39,
                  'char' => 16,
                ),
                1 => 
                array (
                  'type' => 'mcall',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 39,
                        'char' => 18,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 39,
                        'char' => 25,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 39,
                      'char' => 25,
                    ),
                    'name' => 'store',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 39,
                          'char' => 40,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 39,
                        'char' => 40,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectionClass',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 39,
                          'char' => 57,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 39,
                        'char' => 57,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 39,
                    'char' => 58,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 40,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 42,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectionClass',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 42,
                'char' => 31,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 43,
              'char' => 5,
            ),
          ),
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
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 31,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 31,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 31,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 45,
          'char' => 10,
        ),
        2 => 
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
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 45,
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
                  'variable' => 'cacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 47,
                  'char' => 21,
                ),
                1 => 
                array (
                  'variable' => 'reflectedCtor',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 47,
                  'char' => 36,
                ),
                2 => 
                array (
                  'variable' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 47,
                  'char' => 53,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 48,
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
                  'variable' => 'cacheKey',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 48,
                        'char' => 45,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'CACHE_KEY_CTORS',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 48,
                        'char' => 45,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 48,
                      'char' => 45,
                    ),
                    'right' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'strtolower',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'variable',
                            'value' => 'className',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 48,
                            'char' => 66,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 48,
                          'char' => 66,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 48,
                      'char' => 67,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 48,
                    'char' => 67,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 48,
                  'char' => 67,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 50,
              'char' => 11,
            ),
            2 => 
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
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 50,
                        'char' => 34,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 50,
                        'char' => 41,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 50,
                      'char' => 41,
                    ),
                    'name' => 'fetch',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 50,
                          'char' => 56,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 50,
                        'char' => 56,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 50,
                    'char' => 57,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 50,
                  'char' => 57,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 52,
              'char' => 10,
            ),
            3 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflectedCtor',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 52,
                  'char' => 27,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 52,
                'char' => 27,
              ),
              'statements' => 
              array (
                0 => 
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
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 53,
                          'char' => 40,
                        ),
                        'name' => 'getClass',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'className',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 53,
                              'char' => 59,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 53,
                            'char' => 59,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 53,
                        'char' => 60,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 53,
                      'char' => 60,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 54,
                  'char' => 15,
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
                          'value' => 'reflectionClass',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 54,
                          'char' => 49,
                        ),
                        'name' => 'getConstructor',
                        'call-type' => 1,
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 54,
                        'char' => 66,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 54,
                      'char' => 66,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 55,
                  'char' => 16,
                ),
                2 => 
                array (
                  'type' => 'mcall',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 55,
                        'char' => 18,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 55,
                        'char' => 25,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 55,
                      'char' => 25,
                    ),
                    'name' => 'store',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 55,
                          'char' => 40,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 55,
                        'char' => 40,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectedCtor',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 55,
                          'char' => 55,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 55,
                        'char' => 55,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 55,
                    'char' => 56,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 56,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 58,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectedCtor',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 58,
                'char' => 29,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 59,
              'char' => 5,
            ),
          ),
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
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 46,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 46,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 46,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 61,
          'char' => 10,
        ),
        3 => 
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
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 61,
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
                  'variable' => 'cacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 63,
                  'char' => 21,
                ),
                1 => 
                array (
                  'variable' => 'reflectedCtorParams',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 63,
                  'char' => 42,
                ),
                2 => 
                array (
                  'variable' => 'reflectedCtor',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 63,
                  'char' => 57,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 65,
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
                  'variable' => 'cacheKey',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 65,
                        'char' => 51,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'CACHE_KEY_CTOR_PARAMS',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 65,
                        'char' => 51,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 65,
                      'char' => 51,
                    ),
                    'right' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'strtolower',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'variable',
                            'value' => 'className',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 65,
                            'char' => 72,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 65,
                          'char' => 72,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 65,
                      'char' => 73,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 65,
                    'char' => 73,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 65,
                  'char' => 73,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 66,
              'char' => 11,
            ),
            2 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'reflectedCtorParams',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 66,
                        'char' => 40,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 66,
                        'char' => 47,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 66,
                      'char' => 47,
                    ),
                    'name' => 'fetch',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 66,
                          'char' => 62,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 66,
                        'char' => 62,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 66,
                    'char' => 63,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 66,
                  'char' => 63,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 68,
              'char' => 10,
            ),
            3 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectedCtorParams',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 68,
                'char' => 32,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'reflectedCtorParams',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 69,
                    'char' => 39,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 70,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
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
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 71,
                          'char' => 38,
                        ),
                        'name' => 'getCtor',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'className',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 71,
                              'char' => 56,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 71,
                            'char' => 56,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 71,
                        'char' => 57,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 71,
                      'char' => 57,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 72,
                  'char' => 14,
                ),
                1 => 
                array (
                  'type' => 'if',
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'reflectedCtor',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 72,
                    'char' => 30,
                  ),
                  'statements' => 
                  array (
                    0 => 
                    array (
                      'type' => 'let',
                      'assignments' => 
                      array (
                        0 => 
                        array (
                          'assign-type' => 'variable',
                          'operator' => 'assign',
                          'variable' => 'reflectedCtorParams',
                          'expr' => 
                          array (
                            'type' => 'mcall',
                            'variable' => 
                            array (
                              'type' => 'variable',
                              'value' => 'reflectedCtor',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 73,
                              'char' => 57,
                            ),
                            'name' => 'getParameters',
                            'call-type' => 1,
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 73,
                            'char' => 73,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 73,
                          'char' => 73,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 74,
                      'char' => 13,
                    ),
                  ),
                  'else_statements' => 
                  array (
                    0 => 
                    array (
                      'type' => 'let',
                      'assignments' => 
                      array (
                        0 => 
                        array (
                          'assign-type' => 'variable',
                          'operator' => 'assign',
                          'variable' => 'reflectedCtorParams',
                          'expr' => 
                          array (
                            'type' => 'null',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 75,
                            'char' => 47,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 75,
                          'char' => 47,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 76,
                      'char' => 13,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 77,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 79,
              'char' => 12,
            ),
            4 => 
            array (
              'type' => 'mcall',
              'expr' => 
              array (
                'type' => 'mcall',
                'variable' => 
                array (
                  'type' => 'property-access',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'this',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 79,
                    'char' => 14,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'cache',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 79,
                    'char' => 21,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 79,
                  'char' => 21,
                ),
                'name' => 'store',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'cacheKey',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 79,
                      'char' => 36,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 79,
                    'char' => 36,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'reflectedCtorParams',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 79,
                      'char' => 57,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 79,
                    'char' => 57,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 79,
                'char' => 58,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 81,
              'char' => 14,
            ),
            5 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectedCtorParams',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 81,
                'char' => 35,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 82,
              'char' => 5,
            ),
          ),
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
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 62,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 62,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 84,
          'char' => 10,
        ),
        4 => 
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
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 84,
                'char' => 75,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 84,
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
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 84,
                'char' => 105,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 84,
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
                  'variable' => 'lowParam',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 86,
                  'char' => 21,
                ),
                1 => 
                array (
                  'variable' => 'lowClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 86,
                  'char' => 31,
                ),
                2 => 
                array (
                  'variable' => 'lowMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 86,
                  'char' => 42,
                ),
                3 => 
                array (
                  'variable' => 'lowFunc',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 86,
                  'char' => 51,
                ),
                4 => 
                array (
                  'variable' => 'paramCacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 86,
                  'char' => 66,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 87,
              'char' => 11,
            ),
            1 => 
            array (
              'type' => 'declare',
              'data-type' => 'variable',
              'variables' => 
              array (
                0 => 
                array (
                  'variable' => 'classCacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 87,
                  'char' => 26,
                ),
                1 => 
                array (
                  'variable' => 'typeHint',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 87,
                  'char' => 36,
                ),
                2 => 
                array (
                  'variable' => 'reflectionClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 87,
                  'char' => 53,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 89,
              'char' => 11,
            ),
            2 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'lowParam',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'strtolower',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'property-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'param',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 89,
                            'char' => 41,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'name',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 89,
                            'char' => 46,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 89,
                          'char' => 46,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 89,
                        'char' => 46,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 89,
                    'char' => 47,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 89,
                  'char' => 47,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 91,
              'char' => 10,
            ),
            3 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'list',
                'left' => 
                array (
                  'type' => 'instanceof',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'function',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 91,
                    'char' => 31,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => '\\ReflectionMethod',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 91,
                    'char' => 50,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 91,
                  'char' => 50,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 91,
                'char' => 52,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'lowClass',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtolower',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'property-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'function',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 92,
                                'char' => 48,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'class',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 92,
                                'char' => 54,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 92,
                              'char' => 54,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 92,
                            'char' => 54,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 92,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 92,
                      'char' => 55,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 93,
                  'char' => 15,
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
                      'variable' => 'lowMethod',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtolower',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'property-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'function',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 93,
                                'char' => 49,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'name',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 93,
                                'char' => 54,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 93,
                              'char' => 54,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 93,
                            'char' => 54,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 93,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 93,
                      'char' => 55,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 94,
                  'char' => 15,
                ),
                2 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'paramCacheKey',
                      'expr' => 
                      array (
                        'type' => 'concat',
                        'left' => 
                        array (
                          'type' => 'concat',
                          'left' => 
                          array (
                            'type' => 'concat',
                            'left' => 
                            array (
                              'type' => 'concat',
                              'left' => 
                              array (
                                'type' => 'concat',
                                'left' => 
                                array (
                                  'type' => 'concat',
                                  'left' => 
                                  array (
                                    'type' => 'concat',
                                    'left' => 
                                    array (
                                      'type' => 'static-constant-access',
                                      'left' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'self',
                                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                        'line' => 94,
                                        'char' => 57,
                                      ),
                                      'right' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'CACHE_KEY_CLASSES',
                                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                        'line' => 94,
                                        'char' => 57,
                                      ),
                                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                      'line' => 94,
                                      'char' => 57,
                                    ),
                                    'right' => 
                                    array (
                                      'type' => 'variable',
                                      'value' => 'lowClass',
                                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                      'line' => 94,
                                      'char' => 68,
                                    ),
                                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                    'line' => 94,
                                    'char' => 68,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'string',
                                    'value' => '.',
                                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                    'line' => 94,
                                    'char' => 74,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                  'line' => 94,
                                  'char' => 74,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'lowMethod',
                                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                  'line' => 94,
                                  'char' => 86,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 94,
                                'char' => 86,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => '.',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 94,
                                'char' => 92,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 94,
                              'char' => 92,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'param',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 94,
                              'char' => 100,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 94,
                            'char' => 100,
                          ),
                          'right' => 
                          array (
                            'type' => 'string',
                            'value' => '-',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 94,
                            'char' => 106,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 94,
                          'char' => 106,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'lowParam',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 94,
                          'char' => 116,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 94,
                        'char' => 116,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 94,
                      'char' => 116,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 95,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'lowFunc',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'strtolower',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'property-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'function',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 96,
                                'char' => 47,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'name',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 96,
                                'char' => 52,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 96,
                              'char' => 52,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 96,
                            'char' => 52,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 96,
                        'char' => 53,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 96,
                      'char' => 53,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 97,
                  'char' => 14,
                ),
                1 => 
                array (
                  'type' => 'if',
                  'expr' => 
                  array (
                    'type' => 'not-equals',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'lowFunc',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 97,
                      'char' => 25,
                    ),
                    'right' => 
                    array (
                      'type' => 'string',
                      'value' => '{closure}',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 97,
                      'char' => 39,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 97,
                    'char' => 39,
                  ),
                  'statements' => 
                  array (
                    0 => 
                    array (
                      'type' => 'let',
                      'assignments' => 
                      array (
                        0 => 
                        array (
                          'assign-type' => 'variable',
                          'operator' => 'assign',
                          'variable' => 'paramCacheKey',
                          'expr' => 
                          array (
                            'type' => 'concat',
                            'left' => 
                            array (
                              'type' => 'concat',
                              'left' => 
                              array (
                                'type' => 'concat',
                                'left' => 
                                array (
                                  'type' => 'concat',
                                  'left' => 
                                  array (
                                    'type' => 'concat',
                                    'left' => 
                                    array (
                                      'type' => 'concat',
                                      'left' => 
                                      array (
                                        'type' => 'static-constant-access',
                                        'left' => 
                                        array (
                                          'type' => 'variable',
                                          'value' => 'self',
                                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                          'line' => 98,
                                          'char' => 59,
                                        ),
                                        'right' => 
                                        array (
                                          'type' => 'variable',
                                          'value' => 'CACHE_KEY_FUNCS',
                                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                          'line' => 98,
                                          'char' => 59,
                                        ),
                                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                        'line' => 98,
                                        'char' => 59,
                                      ),
                                      'right' => 
                                      array (
                                        'type' => 'string',
                                        'value' => '.',
                                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                        'line' => 98,
                                        'char' => 65,
                                      ),
                                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                      'line' => 98,
                                      'char' => 65,
                                    ),
                                    'right' => 
                                    array (
                                      'type' => 'variable',
                                      'value' => 'lowFunc',
                                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                      'line' => 98,
                                      'char' => 75,
                                    ),
                                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                    'line' => 98,
                                    'char' => 75,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'string',
                                    'value' => '.',
                                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                    'line' => 98,
                                    'char' => 81,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                  'line' => 98,
                                  'char' => 81,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'param',
                                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                  'line' => 98,
                                  'char' => 89,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 98,
                                'char' => 89,
                              ),
                              'right' => 
                              array (
                                'type' => 'string',
                                'value' => '-',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 98,
                                'char' => 95,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 98,
                              'char' => 95,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'lowParam',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 98,
                              'char' => 105,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 98,
                            'char' => 105,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 98,
                          'char' => 105,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 99,
                      'char' => 13,
                    ),
                  ),
                  'else_statements' => 
                  array (
                    0 => 
                    array (
                      'type' => 'let',
                      'assignments' => 
                      array (
                        0 => 
                        array (
                          'assign-type' => 'variable',
                          'operator' => 'assign',
                          'variable' => 'paramCacheKey',
                          'expr' => 
                          array (
                            'type' => 'null',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 100,
                            'char' => 41,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 100,
                          'char' => 41,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 101,
                      'char' => 13,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 102,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 104,
              'char' => 10,
            ),
            4 => 
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
                    'value' => 'paramCacheKey',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 104,
                    'char' => 34,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 104,
                  'char' => 34,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'null',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 104,
                  'char' => 43,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 104,
                'char' => 43,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'typeHint',
                      'expr' => 
                      array (
                        'type' => 'bool',
                        'value' => 'false',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 105,
                        'char' => 33,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 105,
                      'char' => 33,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 106,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'typeHint',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'property-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'this',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 107,
                            'char' => 33,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'cache',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 107,
                            'char' => 40,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 107,
                          'char' => 40,
                        ),
                        'name' => 'fetch',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'paramCacheKey',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 107,
                              'char' => 60,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 107,
                            'char' => 60,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 107,
                        'char' => 61,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 107,
                      'char' => 61,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 108,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 110,
              'char' => 10,
            ),
            5 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not-equals',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'typeHint',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 110,
                  'char' => 22,
                ),
                'right' => 
                array (
                  'type' => 'bool',
                  'value' => 'false',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 110,
                  'char' => 30,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 110,
                'char' => 30,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'typeHint',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 111,
                    'char' => 28,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 112,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 114,
              'char' => 11,
            ),
            6 => 
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
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 114,
                      'char' => 37,
                    ),
                    'name' => 'getClass',
                    'call-type' => 1,
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 114,
                    'char' => 48,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 114,
                  'char' => 48,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 115,
              'char' => 10,
            ),
            7 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectionClass',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 115,
                'char' => 28,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'typeHint',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectionClass',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 116,
                          'char' => 44,
                        ),
                        'name' => 'getName',
                        'call-type' => 1,
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 116,
                        'char' => 54,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 116,
                      'char' => 54,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 117,
                  'char' => 15,
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
                      'variable' => 'classCacheKey',
                      'expr' => 
                      array (
                        'type' => 'concat',
                        'left' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 117,
                            'char' => 57,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'CACHE_KEY_CLASSES',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 117,
                            'char' => 57,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 117,
                          'char' => 57,
                        ),
                        'right' => 
                        array (
                          'type' => 'fcall',
                          'name' => 'strtolower',
                          'call-type' => 1,
                          'parameters' => 
                          array (
                            0 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'variable',
                                'value' => 'typeHint',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 117,
                                'char' => 78,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 117,
                              'char' => 78,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 117,
                          'char' => 79,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 117,
                        'char' => 79,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 117,
                      'char' => 79,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 118,
                  'char' => 16,
                ),
                2 => 
                array (
                  'type' => 'mcall',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 118,
                        'char' => 18,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 118,
                        'char' => 25,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 118,
                      'char' => 25,
                    ),
                    'name' => 'store',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'classCacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 118,
                          'char' => 45,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 118,
                        'char' => 45,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectionClass',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 118,
                          'char' => 62,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 118,
                        'char' => 62,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 118,
                    'char' => 63,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 119,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'typeHint',
                      'expr' => 
                      array (
                        'type' => 'null',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 120,
                        'char' => 32,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 120,
                      'char' => 32,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 121,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 123,
              'char' => 12,
            ),
            8 => 
            array (
              'type' => 'mcall',
              'expr' => 
              array (
                'type' => 'mcall',
                'variable' => 
                array (
                  'type' => 'property-access',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'this',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 123,
                    'char' => 14,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'cache',
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 123,
                    'char' => 21,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 123,
                  'char' => 21,
                ),
                'name' => 'store',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'paramCacheKey',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 123,
                      'char' => 41,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 123,
                    'char' => 41,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'typeHint',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 123,
                      'char' => 51,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 123,
                    'char' => 51,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 123,
                'char' => 52,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 125,
              'char' => 14,
            ),
            9 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'typeHint',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 125,
                'char' => 24,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 126,
              'char' => 5,
            ),
          ),
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
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 85,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 85,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 85,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 128,
          'char' => 10,
        ),
        5 => 
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
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 128,
              'char' => 53,
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
                  'variable' => 'lowFunc',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 130,
                  'char' => 20,
                ),
                1 => 
                array (
                  'variable' => 'cacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 130,
                  'char' => 30,
                ),
                2 => 
                array (
                  'variable' => 'reflectedFunc',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 130,
                  'char' => 45,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 132,
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
                  'variable' => 'lowFunc',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'strtolower',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'functionName',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 132,
                          'char' => 46,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 132,
                        'char' => 46,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 132,
                    'char' => 47,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 132,
                  'char' => 47,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 133,
              'char' => 11,
            ),
            2 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'cacheKey',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 133,
                        'char' => 46,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'CACHE_KEY_FUNCS',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 133,
                        'char' => 46,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 133,
                      'char' => 46,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'lowFunc',
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 133,
                      'char' => 55,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 133,
                    'char' => 55,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 133,
                  'char' => 55,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 135,
              'char' => 11,
            ),
            3 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'reflectedFunc',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 135,
                        'char' => 34,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 135,
                        'char' => 41,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 135,
                      'char' => 41,
                    ),
                    'name' => 'fetch',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 135,
                          'char' => 56,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 135,
                        'char' => 56,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 135,
                    'char' => 57,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 135,
                  'char' => 57,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 137,
              'char' => 10,
            ),
            4 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflectedFunc',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 137,
                  'char' => 27,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 137,
                'char' => 27,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'reflectedFunc',
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
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 138,
                              'char' => 69,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 138,
                            'char' => 69,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 138,
                        'char' => 70,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 138,
                      'char' => 70,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 139,
                  'char' => 16,
                ),
                1 => 
                array (
                  'type' => 'mcall',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 139,
                        'char' => 18,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 139,
                        'char' => 25,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 139,
                      'char' => 25,
                    ),
                    'name' => 'store',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 139,
                          'char' => 40,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 139,
                        'char' => 40,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectedFunc',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 139,
                          'char' => 55,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 139,
                        'char' => 55,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 139,
                    'char' => 56,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 140,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 142,
              'char' => 14,
            ),
            5 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectedFunc',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 142,
                'char' => 29,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 143,
              'char' => 5,
            ),
          ),
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
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 129,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 129,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 129,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 145,
          'char' => 10,
        ),
        6 => 
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
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 145,
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
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 145,
              'char' => 74,
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
                  'variable' => 'className',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 147,
                  'char' => 22,
                ),
                1 => 
                array (
                  'variable' => 'cacheKey',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 147,
                  'char' => 32,
                ),
                2 => 
                array (
                  'variable' => 'reflectedMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 147,
                  'char' => 49,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 149,
              'char' => 10,
            ),
            1 => 
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
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 149,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 149,
                  'char' => 40,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'string',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 149,
                  'char' => 51,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 149,
                'char' => 51,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'className',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'classNameOrInstance',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 150,
                        'char' => 48,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 150,
                      'char' => 48,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 151,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'className',
                      'expr' => 
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
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 152,
                              'char' => 58,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 152,
                            'char' => 58,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 152,
                        'char' => 59,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 152,
                      'char' => 59,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 153,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 155,
              'char' => 11,
            ),
            2 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'cacheKey',
                  'expr' => 
                  array (
                    'type' => 'concat',
                    'left' => 
                    array (
                      'type' => 'concat',
                      'left' => 
                      array (
                        'type' => 'concat',
                        'left' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 155,
                            'char' => 48,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'CACHE_KEY_METHODS',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 155,
                            'char' => 48,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 155,
                          'char' => 48,
                        ),
                        'right' => 
                        array (
                          'type' => 'fcall',
                          'name' => 'strtolower',
                          'call-type' => 1,
                          'parameters' => 
                          array (
                            0 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'variable',
                                'value' => 'className',
                                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                                'line' => 155,
                                'char' => 70,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 155,
                              'char' => 70,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 155,
                          'char' => 72,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 155,
                        'char' => 72,
                      ),
                      'right' => 
                      array (
                        'type' => 'string',
                        'value' => '.',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 155,
                        'char' => 78,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 155,
                      'char' => 78,
                    ),
                    'right' => 
                    array (
                      'type' => 'fcall',
                      'name' => 'strtolower',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'variable',
                            'value' => 'methodName',
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 155,
                            'char' => 101,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 155,
                          'char' => 101,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 155,
                      'char' => 102,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 155,
                    'char' => 102,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 155,
                  'char' => 102,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 157,
              'char' => 11,
            ),
            3 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'reflectedMethod',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 157,
                        'char' => 36,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 157,
                        'char' => 43,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 157,
                      'char' => 43,
                    ),
                    'name' => 'fetch',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 157,
                          'char' => 58,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 157,
                        'char' => 58,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 157,
                    'char' => 59,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 157,
                  'char' => 59,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 158,
              'char' => 10,
            ),
            4 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflectedMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 158,
                  'char' => 29,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 158,
                'char' => 29,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'reflectedMethod',
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
                              'value' => 'className',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 159,
                              'char' => 66,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 159,
                            'char' => 66,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'methodName',
                              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                              'line' => 159,
                              'char' => 78,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                            'line' => 159,
                            'char' => 78,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 159,
                        'char' => 79,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 159,
                      'char' => 79,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 160,
                  'char' => 16,
                ),
                1 => 
                array (
                  'type' => 'mcall',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 160,
                        'char' => 18,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'cache',
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 160,
                        'char' => 25,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                      'line' => 160,
                      'char' => 25,
                    ),
                    'name' => 'store',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'cacheKey',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 160,
                          'char' => 40,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 160,
                        'char' => 40,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectedMethod',
                          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                          'line' => 160,
                          'char' => 57,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                        'line' => 160,
                        'char' => 57,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                    'line' => 160,
                    'char' => 58,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 161,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 163,
              'char' => 14,
            ),
            5 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'reflectedMethod',
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 163,
                'char' => 31,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
              'line' => 164,
              'char' => 5,
            ),
          ),
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
                  'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                  'line' => 146,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
                'line' => 146,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 146,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 165,
          'char' => 1,
        ),
      ),
      'constants' => 
      array (
        0 => 
        array (
          'type' => 'const',
          'name' => 'CACHE_KEY_CLASSES',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'auryn.refls.classes.',
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 6,
            'char' => 53,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 7,
          'char' => 9,
        ),
        1 => 
        array (
          'type' => 'const',
          'name' => 'CACHE_KEY_CTORS',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'auryn.refls.ctors.',
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 7,
            'char' => 49,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 8,
          'char' => 9,
        ),
        2 => 
        array (
          'type' => 'const',
          'name' => 'CACHE_KEY_CTOR_PARAMS',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'auryn.refls.ctor-params.',
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 8,
            'char' => 61,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 9,
          'char' => 9,
        ),
        3 => 
        array (
          'type' => 'const',
          'name' => 'CACHE_KEY_FUNCS',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'auryn.refls.funcs.',
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 9,
            'char' => 49,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 10,
          'char' => 9,
        ),
        4 => 
        array (
          'type' => 'const',
          'name' => 'CACHE_KEY_METHODS',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'auryn.refls.methods.',
            'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
            'line' => 10,
            'char' => 53,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
          'line' => 12,
          'char' => 13,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
      'line' => 165,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/cachingreflector.zep',
    'line' => 166,
    'char' => 0,
  ),
);