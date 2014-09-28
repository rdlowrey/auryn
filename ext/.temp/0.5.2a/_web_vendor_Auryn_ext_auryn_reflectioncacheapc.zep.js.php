<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'ReflectionCacheApc',
    'abstract' => 0,
    'final' => 0,
    'implements' => 
    array (
      0 => 
      array (
        'type' => 'variable',
        'value' => 'ReflectionCacheInterface',
        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
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
            0 => 'private',
          ),
          'type' => 'property',
          'name' => 'localCache',
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
          'line' => 7,
          'char' => 11,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'private',
          ),
          'type' => 'property',
          'name' => 'timeToLive',
          'default' => 
          array (
            'type' => 'int',
            'value' => '5',
            'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
            'line' => 7,
            'char' => 27,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
          'line' => 9,
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
              'name' => 'localCache',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => 'ReflectionCacheInterface',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 9,
                'char' => 69,
              ),
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 9,
                'char' => 77,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 9,
              'char' => 77,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not-equals',
                'left' => 
                array (
                  'type' => 'typeof',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'localCache',
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 11,
                    'char' => 31,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 11,
                  'char' => 31,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'null',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 11,
                  'char' => 40,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 11,
                'char' => 40,
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
                      'property' => 'localCache',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'localCache',
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 12,
                        'char' => 46,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 12,
                      'char' => 46,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 13,
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
                      'property' => 'localCache',
                      'expr' => 
                      array (
                        'type' => 'new',
                        'class' => 'ReflectionCacheArray',
                        'dynamic' => 0,
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 14,
                        'char' => 62,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 14,
                      'char' => 62,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 15,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 16,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
          'line' => 18,
          'char' => 10,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'setTimeToLive',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'seconds',
              'const' => 0,
              'data-type' => 'int',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 18,
              'char' => 46,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'greater',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'seconds',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 20,
                  'char' => 20,
                ),
                'right' => 
                array (
                  'type' => 'int',
                  'value' => '0',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 20,
                  'char' => 24,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 20,
                'char' => 24,
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
                      'property' => 'timeToLive',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'seconds',
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 21,
                        'char' => 43,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 21,
                      'char' => 43,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 22,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 23,
              'char' => 14,
            ),
            1 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 23,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 24,
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
                  'value' => 'ReflectionCacheInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 19,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 19,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
            'line' => 19,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
          'line' => 26,
          'char' => 10,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'fetch',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'key',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 26,
              'char' => 38,
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
                  'variable' => 'localData',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 28,
                  'char' => 22,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 29,
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
                  'variable' => 'localData',
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
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 29,
                        'char' => 30,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'localCache',
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 29,
                        'char' => 42,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 29,
                      'char' => 42,
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
                          'value' => 'key',
                          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                          'line' => 29,
                          'char' => 52,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 29,
                        'char' => 52,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 29,
                    'char' => 53,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 29,
                  'char' => 53,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 31,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'localData',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 31,
                'char' => 22,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'localData',
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 32,
                    'char' => 29,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 33,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 35,
              'char' => 10,
            ),
            3 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'apc_exists',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'key',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 35,
                      'char' => 26,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 35,
                    'char' => 26,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 35,
                'char' => 28,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'apc_fetch',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'key',
                          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                          'line' => 36,
                          'char' => 33,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 36,
                        'char' => 33,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 36,
                    'char' => 34,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 37,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 39,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'bool',
                'value' => 'false',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 39,
                'char' => 21,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 40,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
          'line' => 42,
          'char' => 10,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'store',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'key',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 42,
              'char' => 38,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'data',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 42,
              'char' => 48,
            ),
          ),
          'statements' => 
          array (
            0 => 
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
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 44,
                    'char' => 14,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'localCache',
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 44,
                    'char' => 26,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 44,
                  'char' => 26,
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
                      'value' => 'key',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 44,
                      'char' => 36,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 44,
                    'char' => 36,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'data',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 44,
                      'char' => 42,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 44,
                    'char' => 42,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 44,
                'char' => 43,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 45,
              'char' => 17,
            ),
            1 => 
            array (
              'type' => 'fcall',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'apc_store',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'key',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 45,
                      'char' => 22,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 45,
                    'char' => 22,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'data',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 45,
                      'char' => 28,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 45,
                    'char' => 28,
                  ),
                  2 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 45,
                        'char' => 35,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'timeToLive',
                        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                        'line' => 45,
                        'char' => 46,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                      'line' => 45,
                      'char' => 46,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                    'line' => 45,
                    'char' => 46,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 45,
                'char' => 47,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 46,
              'char' => 14,
            ),
            2 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 46,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
              'line' => 47,
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
                  'value' => 'ReflectionCacheInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                  'line' => 43,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
                'line' => 43,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
            'line' => 43,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
          'line' => 48,
          'char' => 1,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
      'line' => 48,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncacheapc.zep',
    'line' => 49,
    'char' => 0,
  ),
);