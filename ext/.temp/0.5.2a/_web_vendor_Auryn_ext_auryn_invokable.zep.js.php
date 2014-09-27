<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
    'line' => 4,
    'char' => 5,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'Invokable',
    'abstract' => 0,
    'final' => 0,
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
          'name' => 'reflFunc',
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
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
          'name' => 'invokeObj',
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 8,
          'char' => 11,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'private',
          ),
          'type' => 'property',
          'name' => 'isInstanceMethod',
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 10,
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
              'name' => 'reflFunc',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => '\\ReflectionFunctionAbstract',
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 10,
                'char' => 70,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 10,
              'char' => 71,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'invokeObj',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 10,
                'char' => 93,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 10,
              'char' => 93,
            ),
          ),
          'statements' => 
          array (
            0 => 
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
                    'value' => 'reflFunc',
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 12,
                    'char' => 31,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => '\\ReflectionMethod',
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 12,
                    'char' => 50,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 12,
                  'char' => 50,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 12,
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
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'isInstanceMethod',
                      'expr' => 
                      array (
                        'type' => 'bool',
                        'value' => 'true',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 13,
                        'char' => 46,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 13,
                      'char' => 46,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 14,
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
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 14,
                      'char' => 18,
                    ),
                    'name' => 'setMethodCallable',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflFunc',
                          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                          'line' => 14,
                          'char' => 45,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 14,
                        'char' => 45,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'invokeObj',
                          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                          'line' => 14,
                          'char' => 56,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 14,
                        'char' => 56,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 14,
                    'char' => 57,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 15,
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
                      'property' => 'isInstanceMethod',
                      'expr' => 
                      array (
                        'type' => 'bool',
                        'value' => 'false',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 16,
                        'char' => 47,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 16,
                      'char' => 47,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 17,
                  'char' => 15,
                ),
                1 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'reflFunc',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'reflFunc',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 17,
                        'char' => 42,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 17,
                      'char' => 42,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 18,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 19,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 21,
          'char' => 11,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'private',
          ),
          'type' => 'method',
          'name' => 'setMethodCallable',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'reflection',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'cast' => 
              array (
                'type' => 'variable',
                'value' => '\\ReflectionMethod',
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 21,
                'char' => 69,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 21,
              'char' => 70,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'invokeObj',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 21,
              'char' => 85,
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
                    'value' => 'invokeObj',
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 23,
                    'char' => 30,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 23,
                  'char' => 30,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'object',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 23,
                  'char' => 41,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 23,
                'char' => 41,
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
                      'property' => 'reflFunc',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'reflection',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 24,
                        'char' => 44,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 24,
                      'char' => 44,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 25,
                  'char' => 15,
                ),
                1 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'invokeObj',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'invokeObj',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 25,
                        'char' => 44,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 25,
                      'char' => 44,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 26,
                  'char' => 9,
                ),
              ),
              'else_statements' => 
              array (
                0 => 
                array (
                  'type' => 'if',
                  'expr' => 
                  array (
                    'type' => 'list',
                    'left' => 
                    array (
                      'type' => 'mcall',
                      'variable' => 
                      array (
                        'type' => 'variable',
                        'value' => 'reflection',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 27,
                        'char' => 28,
                      ),
                      'name' => 'isStatic',
                      'call-type' => 1,
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 27,
                      'char' => 39,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 27,
                    'char' => 41,
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
                          'property' => 'reflFunc',
                          'expr' => 
                          array (
                            'type' => 'variable',
                            'value' => 'reflection',
                            'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                            'line' => 28,
                            'char' => 48,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                          'line' => 28,
                          'char' => 48,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 29,
                      'char' => 13,
                    ),
                  ),
                  'else_statements' => 
                  array (
                    0 => 
                    array (
                      'type' => 'throw',
                      'expr' => 
                      array (
                        'type' => 'new',
                        'class' => '\\Exception',
                        'dynamic' => 0,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'string',
                              'value' => 'ReflectionMethod callables must specify an invocation object',
                              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                              'line' => 30,
                              'char' => 100,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                            'line' => 30,
                            'char' => 100,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 30,
                        'char' => 101,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 31,
                      'char' => 13,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 32,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 33,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 35,
          'char' => 10,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => '__invoke',
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
                  'variable' => 'args',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 37,
                  'char' => 17,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 38,
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
                  'variable' => 'args',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'func_get_args',
                    'call-type' => 1,
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 38,
                    'char' => 35,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 38,
                  'char' => 35,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 40,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'property-access',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'this',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 40,
                  'char' => 17,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'isInstanceMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 40,
                  'char' => 35,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 40,
                'char' => 35,
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
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 41,
                        'char' => 25,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'reflFunc',
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 41,
                        'char' => 35,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 41,
                      'char' => 35,
                    ),
                    'name' => 'invokeArgs',
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
                            'value' => 'this',
                            'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                            'line' => 41,
                            'char' => 52,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'invokeObj',
                            'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                            'line' => 41,
                            'char' => 62,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                          'line' => 41,
                          'char' => 62,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 41,
                        'char' => 62,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'args',
                          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                          'line' => 41,
                          'char' => 68,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                        'line' => 41,
                        'char' => 68,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 41,
                    'char' => 69,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 42,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 43,
              'char' => 14,
            ),
            3 => 
            array (
              'type' => 'return',
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
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 43,
                    'char' => 21,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'reflFunc',
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 43,
                    'char' => 31,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 43,
                  'char' => 31,
                ),
                'name' => 'invokeArgs',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'args',
                      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                      'line' => 43,
                      'char' => 47,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                    'line' => 43,
                    'char' => 47,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 43,
                'char' => 48,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 44,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 46,
          'char' => 10,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getCallableReflection',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'property-access',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'this',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 48,
                  'char' => 21,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflFunc',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 48,
                  'char' => 30,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 48,
                'char' => 30,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 49,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 51,
          'char' => 10,
        ),
        4 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'getInvocationObject',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'property-access',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'this',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 53,
                  'char' => 21,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'invokeObj',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 53,
                  'char' => 31,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 53,
                'char' => 31,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 54,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 56,
          'char' => 10,
        ),
        5 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'isInstanceMethod',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'property-access',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'this',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 58,
                  'char' => 21,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'isInstanceMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                  'line' => 58,
                  'char' => 38,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
                'line' => 58,
                'char' => 38,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
              'line' => 59,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
          'line' => 60,
          'char' => 1,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
      'line' => 60,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/invokable.zep',
    'line' => 61,
    'char' => 0,
  ),
);