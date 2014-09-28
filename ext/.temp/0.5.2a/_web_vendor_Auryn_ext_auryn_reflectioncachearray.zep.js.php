<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'ReflectionCacheArray',
    'abstract' => 0,
    'final' => 0,
    'implements' => 
    array (
      0 => 
      array (
        'type' => 'variable',
        'value' => 'ReflectionCacheInterface',
        'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
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
          'name' => 'cache',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
            'line' => 9,
            'char' => 23,
          ),
          'docblock' => '**
     * @var array
     *',
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
          'line' => 13,
          'char' => 6,
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
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 14,
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
                  'variable' => 'value',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                  'line' => 16,
                  'char' => 18,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 17,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'fetch',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'value',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                  'line' => 17,
                  'char' => 42,
                ),
                'right' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                      'line' => 17,
                      'char' => 30,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'cache',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                      'line' => 17,
                      'char' => 36,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                    'line' => 17,
                    'char' => 36,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'key',
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                    'line' => 17,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                  'line' => 17,
                  'char' => 42,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                'line' => 17,
                'char' => 42,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'value',
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                    'line' => 18,
                    'char' => 25,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                  'line' => 19,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 20,
              'char' => 14,
            ),
            2 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'bool',
                'value' => 'false',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                'line' => 20,
                'char' => 21,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 21,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * {@inheritDoc}
     *',
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
          'line' => 25,
          'char' => 6,
        ),
        1 => 
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
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 26,
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
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 26,
              'char' => 48,
            ),
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
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'cache',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'key',
                      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                      'line' => 28,
                      'char' => 28,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'data',
                    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                    'line' => 28,
                    'char' => 36,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                  'line' => 28,
                  'char' => 36,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 29,
              'char' => 14,
            ),
            1 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                'line' => 29,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
              'line' => 30,
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
                  'value' => 'ReflectionCacheInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                  'line' => 27,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
                'line' => 27,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
            'line' => 27,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
          'line' => 31,
          'char' => 1,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
      'line' => 31,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/reflectioncachearray.zep',
    'line' => 32,
    'char' => 0,
  ),
);