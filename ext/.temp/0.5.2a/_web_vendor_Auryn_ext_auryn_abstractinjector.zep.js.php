<?php return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'Auryn',
    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
    'line' => 4,
    'char' => 8,
  ),
  1 => 
  array (
    'type' => 'class',
    'name' => 'AbstractInjector',
    'abstract' => 1,
    'final' => 0,
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
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 28,
          'char' => 13,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'bindings',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 28,
            'char' => 28,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 29,
          'char' => 13,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'aliases',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 29,
            'char' => 27,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 30,
          'char' => 13,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'shares',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 30,
            'char' => 26,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 31,
          'char' => 13,
        ),
        4 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'mutators',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 31,
            'char' => 28,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 32,
          'char' => 13,
        ),
        5 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'delegates',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 32,
            'char' => 29,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 33,
          'char' => 13,
        ),
        6 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'paramDefinitions',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 33,
            'char' => 36,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 34,
          'char' => 13,
        ),
        7 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'inProgress',
          'default' => 
          array (
            'type' => 'empty-array',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 34,
            'char' => 30,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 36,
          'char' => 13,
        ),
        8 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
            1 => 'static',
          ),
          'type' => 'property',
          'name' => 'errorMessages',
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 38,
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
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 38,
                'char' => 62,
              ),
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 38,
                'char' => 70,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 38,
              'char' => 70,
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
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 40,
                      'char' => 39,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 40,
                    'char' => 39,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'null',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 40,
                    'char' => 48,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 40,
                  'char' => 48,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 40,
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
                        'class' => 'CachingReflector',
                        'dynamic' => 0,
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 41,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 41,
                      'char' => 55,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 42,
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
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 43,
                        'char' => 44,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 43,
                      'char' => 44,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 44,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 46,
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
                  'type' => 'empty',
                  'left' => 
                  array (
                    'type' => 'static-property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'self',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 46,
                      'char' => 47,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'errorMessages',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 46,
                      'char' => 47,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 46,
                    'char' => 47,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 46,
                  'char' => 47,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 46,
                'char' => 47,
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
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 47,
                            'char' => 67,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_NON_EMPTY_STRING_ALIAS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 47,
                            'char' => 67,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 47,
                          'char' => 67,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Invalid alias: non-empty string required at both Argument 1 and Argument 2',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 47,
                        'char' => 147,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 47,
                      'char' => 147,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 48,
                  'char' => 15,
                ),
                1 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 48,
                            'char' => 64,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_SHARED_CANNOT_ALIAS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 48,
                            'char' => 64,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 48,
                          'char' => 64,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Cannot alias class %s to %s: it is already shared',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 48,
                        'char' => 119,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 48,
                      'char' => 119,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 49,
                  'char' => 15,
                ),
                2 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 49,
                            'char' => 59,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_SHARE_ARGUMENT',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 49,
                            'char' => 59,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 49,
                          'char' => 59,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => '%s::share() requires a string class name or object instance at Argument 1; %s specified',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 49,
                        'char' => 152,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 49,
                      'char' => 152,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 50,
                  'char' => 15,
                ),
                3 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 50,
                            'char' => 65,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_ALIASED_CANNOT_SHARE',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 50,
                            'char' => 65,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 50,
                          'char' => 65,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Cannot share class %s, it has already been aliased to %s',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 50,
                        'char' => 127,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 50,
                      'char' => 127,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 51,
                  'char' => 15,
                ),
                4 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 51,
                            'char' => 54,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_INVOKABLE',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 51,
                            'char' => 54,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 51,
                          'char' => 54,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Invalid invokable: callable or provisional string required',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 51,
                        'char' => 118,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 51,
                      'char' => 118,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 52,
                  'char' => 15,
                ),
                5 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 52,
                            'char' => 67,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_NON_PUBLIC_CONSTRUCTOR',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 52,
                            'char' => 67,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 52,
                          'char' => 67,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Cannot instantiate class %s; constructor method is protected/private',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 52,
                        'char' => 141,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 52,
                      'char' => 141,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 53,
                  'char' => 15,
                ),
                6 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 53,
                            'char' => 61,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_NEEDS_DEFINITION',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 53,
                            'char' => 61,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 53,
                          'char' => 61,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Injection definition/implementation required for non-concrete parameter $%s of type %s',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 53,
                        'char' => 153,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 53,
                      'char' => 153,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 54,
                  'char' => 15,
                ),
                7 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 54,
                            'char' => 57,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_MAKE_FAILURE',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 54,
                            'char' => 57,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 54,
                          'char' => 57,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Could not make %s: %s',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 54,
                        'char' => 84,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 54,
                      'char' => 84,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 55,
                  'char' => 15,
                ),
                8 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 55,
                            'char' => 60,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_UNDEFINED_PARAM',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 55,
                            'char' => 60,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 55,
                          'char' => 60,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'No definition available while attempting to provision typeless non-concrete parameter %s(%s)',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 55,
                        'char' => 158,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 55,
                      'char' => 158,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 56,
                  'char' => 15,
                ),
                9 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 56,
                            'char' => 62,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_DELEGATE_ARGUMENT',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 56,
                            'char' => 62,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 56,
                          'char' => 62,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => '%s::delegate expects a valid callable or provisionable executable class or method reference at Argument 2',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 56,
                        'char' => 173,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 56,
                      'char' => 173,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 57,
                  'char' => 15,
                ),
                10 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'static-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'self',
                      'property' => 'errorMessages',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 57,
                            'char' => 62,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_CYCLIC_DEPENDENCY',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 57,
                            'char' => 62,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 57,
                          'char' => 62,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'string',
                        'value' => 'Detected a cyclic dependency while provisioning %s',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 57,
                        'char' => 118,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 57,
                      'char' => 118,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 58,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 59,
              'char' => 5,
            ),
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 67,
          'char' => 6,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'bind',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 68,
              'char' => 38,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'args',
              'const' => 0,
              'data-type' => 'array',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 68,
              'char' => 50,
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
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 70,
                  'char' => 18,
                ),
                1 => 
                array (
                  'variable' => 'normalizedName',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 70,
                  'char' => 34,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 71,
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
                  'variable' => 'value',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 71,
                      'char' => 26,
                    ),
                    'name' => 'resolveAlias',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 71,
                          'char' => 44,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 71,
                        'char' => 44,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 71,
                    'char' => 45,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 71,
                  'char' => 45,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 72,
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
                  'variable' => 'normalizedName',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'end',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'value',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 72,
                          'char' => 39,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 72,
                        'char' => 39,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 72,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 72,
                  'char' => 40,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 73,
              'char' => 11,
            ),
            3 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'bindings',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedName',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 73,
                      'char' => 42,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'args',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 73,
                    'char' => 50,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 73,
                  'char' => 50,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 74,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 74,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 75,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Bind instantiation directives for the specified class
     *
     * @param string name The class (or alias) whose constructor arguments we wish to bind
     * @param array args An array mapping parameter names to values/instructions
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 69,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 69,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 69,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 86,
          'char' => 6,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'bindParam',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'paramName',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 87,
              'char' => 48,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'value',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 87,
              'char' => 59,
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
                  'property' => 'paramDefinitions',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'paramName',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 89,
                      'char' => 45,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'value',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 89,
                    'char' => 54,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 89,
                  'char' => 54,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 90,
              'char' => 14,
            ),
            1 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 90,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 91,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param string paramName The parameter name for which this value applies
     * @param mixed value The value to inject for this parameter name
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 88,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 88,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 88,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 101,
          'char' => 6,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'alias',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'original',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 102,
              'char' => 43,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'alias',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 102,
              'char' => 58,
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
                  'variable' => 'originalNormalized',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 104,
                  'char' => 31,
                ),
                1 => 
                array (
                  'variable' => 'aliasNormalized',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 104,
                  'char' => 48,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 106,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'or',
                'left' => 
                array (
                  'type' => 'empty',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'original',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 106,
                    'char' => 28,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 106,
                  'char' => 28,
                ),
                'right' => 
                array (
                  'type' => 'not-equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'original',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 106,
                      'char' => 47,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 106,
                    'char' => 47,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'string',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 106,
                    'char' => 58,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 106,
                  'char' => 58,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 106,
                'char' => 58,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'static-property-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => 'self',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 108,
                              'char' => 36,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'errorMessages',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 108,
                              'char' => 36,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 108,
                            'char' => 36,
                          ),
                          'right' => 
                          array (
                            'type' => 'static-constant-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => 'self',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 108,
                              'char' => 67,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'E_NON_EMPTY_STRING_ALIAS',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 108,
                              'char' => 67,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 108,
                            'char' => 67,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 108,
                          'char' => 68,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 108,
                        'char' => 68,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 110,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_NON_EMPTY_STRING_ALIAS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 110,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 110,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 110,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 110,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 111,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 113,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'or',
                'left' => 
                array (
                  'type' => 'empty',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'alias',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 113,
                    'char' => 25,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 113,
                  'char' => 25,
                ),
                'right' => 
                array (
                  'type' => 'not-equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'alias',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 113,
                      'char' => 41,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 113,
                    'char' => 41,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'string',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 113,
                    'char' => 52,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 113,
                  'char' => 52,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 113,
                'char' => 52,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'static-property-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => 'self',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 115,
                              'char' => 36,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'errorMessages',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 115,
                              'char' => 36,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 115,
                            'char' => 36,
                          ),
                          'right' => 
                          array (
                            'type' => 'static-constant-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => 'self',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 115,
                              'char' => 67,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'E_NON_EMPTY_STRING_ALIAS',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 115,
                              'char' => 67,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 115,
                            'char' => 67,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 115,
                          'char' => 68,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 115,
                        'char' => 68,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 117,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_NON_EMPTY_STRING_ALIAS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 117,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 117,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 117,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 117,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 118,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 120,
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
                  'variable' => 'originalNormalized',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 120,
                      'char' => 39,
                    ),
                    'name' => 'normalizeName',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'original',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 120,
                          'char' => 62,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 120,
                        'char' => 62,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 120,
                    'char' => 63,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 120,
                  'char' => 63,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 122,
              'char' => 10,
            ),
            4 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'isset',
                'left' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 122,
                      'char' => 23,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'shares',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 122,
                      'char' => 30,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 122,
                    'char' => 30,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'originalNormalized',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 122,
                    'char' => 49,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 122,
                  'char' => 51,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 122,
                'char' => 51,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'fcall',
                          'name' => 'sprintf',
                          'call-type' => 1,
                          'parameters' => 
                          array (
                            0 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'array-access',
                                'left' => 
                                array (
                                  'type' => 'static-property-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 125,
                                    'char' => 40,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'errorMessages',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 125,
                                    'char' => 40,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 125,
                                  'char' => 40,
                                ),
                                'right' => 
                                array (
                                  'type' => 'static-constant-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 125,
                                    'char' => 68,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'E_SHARED_CANNOT_ALIAS',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 125,
                                    'char' => 68,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 125,
                                  'char' => 68,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 125,
                                'char' => 69,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 125,
                              'char' => 69,
                            ),
                            1 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'mcall',
                                'variable' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'this',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 126,
                                  'char' => 26,
                                ),
                                'name' => 'normalizeName',
                                'call-type' => 1,
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
                                            'type' => 'array-access',
                                            'left' => 
                                            array (
                                              'type' => 'property-access',
                                              'left' => 
                                              array (
                                                'type' => 'variable',
                                                'value' => 'this',
                                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                                'line' => 126,
                                                'char' => 56,
                                              ),
                                              'right' => 
                                              array (
                                                'type' => 'variable',
                                                'value' => 'shares',
                                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                                'line' => 126,
                                                'char' => 63,
                                              ),
                                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                              'line' => 126,
                                              'char' => 63,
                                            ),
                                            'right' => 
                                            array (
                                              'type' => 'variable',
                                              'value' => 'originalNormalized',
                                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                              'line' => 126,
                                              'char' => 82,
                                            ),
                                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                            'line' => 126,
                                            'char' => 83,
                                          ),
                                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                          'line' => 126,
                                          'char' => 83,
                                        ),
                                      ),
                                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                      'line' => 126,
                                      'char' => 84,
                                    ),
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 126,
                                    'char' => 84,
                                  ),
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 126,
                                'char' => 85,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 126,
                              'char' => 85,
                            ),
                            2 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'variable',
                                'value' => 'alias',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 128,
                                'char' => 17,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 128,
                              'char' => 17,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 128,
                          'char' => 18,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 128,
                        'char' => 18,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 130,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_SHARED_CANNOT_ALIAS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 130,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 130,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 130,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 130,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 131,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 133,
              'char' => 10,
            ),
            5 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'array_key_exists',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'originalNormalized',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 133,
                      'char' => 47,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 133,
                    'char' => 47,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 133,
                        'char' => 54,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'shares',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 133,
                        'char' => 61,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 133,
                      'char' => 61,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 133,
                    'char' => 61,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 133,
                'char' => 63,
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
                      'variable' => 'aliasNormalized',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 134,
                          'char' => 40,
                        ),
                        'name' => 'normalizeName',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'alias',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 134,
                              'char' => 60,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 134,
                            'char' => 60,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 134,
                        'char' => 61,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 134,
                      'char' => 61,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 135,
                  'char' => 15,
                ),
                1 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property-array-index',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'shares',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'variable',
                          'value' => 'aliasNormalized',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 135,
                          'char' => 45,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'null',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 135,
                        'char' => 53,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 135,
                      'char' => 53,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 136,
                  'char' => 17,
                ),
                2 => 
                array (
                  'type' => 'unset',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 136,
                        'char' => 24,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'shares',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 136,
                        'char' => 31,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 136,
                      'char' => 31,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'originalNormalized',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 136,
                      'char' => 50,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 136,
                    'char' => 51,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 137,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 139,
              'char' => 11,
            ),
            6 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'aliases',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'originalNormalized',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 139,
                      'char' => 45,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'alias',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 139,
                    'char' => 54,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 139,
                  'char' => 54,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 141,
              'char' => 14,
            ),
            7 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 141,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 142,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Define an alias for all occurrences of a given typehint
     *
     * Use this method to specify implementation classes for interface and abstract class typehints.
     *
     * @param string original The typehint to replace
     * @param string alias The implementation name
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 103,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 103,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 103,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 144,
          'char' => 13,
        ),
        4 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'normalizeName',
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
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 144,
              'char' => 55,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'ltrim',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 146,
                            'char' => 42,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 146,
                          'char' => 42,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 146,
                      'char' => 43,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 146,
                    'char' => 43,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'string',
                      'value' => '\\\\',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 146,
                      'char' => 49,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 146,
                    'char' => 49,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 146,
                'char' => 50,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 147,
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
                'data-type' => 'string',
                'mandatory' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 145,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 145,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 154,
          'char' => 6,
        ),
        5 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'share',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'nameOrInstance',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 155,
              'char' => 45,
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
                    'value' => 'nameOrInstance',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 157,
                    'char' => 35,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 157,
                  'char' => 35,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'string',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 157,
                  'char' => 46,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 157,
                'char' => 46,
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
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 158,
                      'char' => 18,
                    ),
                    'name' => 'shareClass',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'nameOrInstance',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 158,
                          'char' => 44,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 158,
                        'char' => 44,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 158,
                    'char' => 45,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 159,
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
                    'type' => 'equals',
                    'left' => 
                    array (
                      'type' => 'typeof',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'nameOrInstance',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 160,
                        'char' => 39,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 160,
                      'char' => 39,
                    ),
                    'right' => 
                    array (
                      'type' => 'string',
                      'value' => 'object',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 160,
                      'char' => 50,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 160,
                    'char' => 50,
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
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 161,
                          'char' => 22,
                        ),
                        'name' => 'shareInstance',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'nameOrInstance',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 161,
                              'char' => 51,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 161,
                            'char' => 51,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 161,
                        'char' => 52,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 162,
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
                        'class' => 'InjectorException',
                        'dynamic' => 0,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'fcall',
                              'name' => 'sprintf',
                              'call-type' => 1,
                              'parameters' => 
                              array (
                                0 => 
                                array (
                                  'parameter' => 
                                  array (
                                    'type' => 'array-access',
                                    'left' => 
                                    array (
                                      'type' => 'static-property-access',
                                      'left' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'self',
                                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                        'line' => 165,
                                        'char' => 44,
                                      ),
                                      'right' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'errorMessages',
                                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                        'line' => 165,
                                        'char' => 44,
                                      ),
                                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                      'line' => 165,
                                      'char' => 44,
                                    ),
                                    'right' => 
                                    array (
                                      'type' => 'static-constant-access',
                                      'left' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'self',
                                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                        'line' => 165,
                                        'char' => 67,
                                      ),
                                      'right' => 
                                      array (
                                        'type' => 'variable',
                                        'value' => 'E_SHARE_ARGUMENT',
                                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                        'line' => 165,
                                        'char' => 67,
                                      ),
                                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                      'line' => 165,
                                      'char' => 67,
                                    ),
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 165,
                                    'char' => 68,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 165,
                                  'char' => 68,
                                ),
                                1 => 
                                array (
                                  'parameter' => 
                                  array (
                                    'type' => 'constant',
                                    'value' => '__CLASS__',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 166,
                                    'char' => 34,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 166,
                                  'char' => 34,
                                ),
                                2 => 
                                array (
                                  'parameter' => 
                                  array (
                                    'type' => 'fcall',
                                    'name' => 'gettype',
                                    'call-type' => 1,
                                    'parameters' => 
                                    array (
                                      0 => 
                                      array (
                                        'parameter' => 
                                        array (
                                          'type' => 'variable',
                                          'value' => 'nameOrInstance',
                                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                          'line' => 167,
                                          'char' => 47,
                                        ),
                                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                        'line' => 167,
                                        'char' => 47,
                                      ),
                                    ),
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 168,
                                    'char' => 21,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 168,
                                  'char' => 21,
                                ),
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 168,
                              'char' => 22,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 168,
                            'char' => 22,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'static-constant-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'self',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 170,
                                'char' => 17,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'E_SHARE_ARGUMENT',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 170,
                                'char' => 17,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 170,
                              'char' => 17,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 170,
                            'char' => 17,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 170,
                        'char' => 18,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 171,
                      'char' => 13,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 172,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 174,
              'char' => 14,
            ),
            1 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 174,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 175,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Share the specified class/instance across the Injector context
     *
     * @param mixed $nameOrInstance The class or object to share
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 156,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 156,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 156,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 180,
          'char' => 6,
        ),
        6 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'shareClass',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'nameOrInstance',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 181,
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
                  'variable' => 'value',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 183,
                  'char' => 18,
                ),
                1 => 
                array (
                  'variable' => 'normalizedName',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 183,
                  'char' => 34,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 184,
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
                  'variable' => 'value',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 184,
                      'char' => 26,
                    ),
                    'name' => 'resolveAlias',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'nameOrInstance',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 184,
                          'char' => 54,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 184,
                        'char' => 54,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 184,
                    'char' => 55,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 184,
                  'char' => 55,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 185,
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
                  'variable' => 'normalizedName',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'end',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'value',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 185,
                          'char' => 39,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 185,
                        'char' => 39,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 185,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 185,
                  'char' => 40,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 187,
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
                  'type' => 'unlikely',
                  'left' => 
                  array (
                    'type' => 'isset',
                    'left' => 
                    array (
                      'type' => 'array-access',
                      'left' => 
                      array (
                        'type' => 'property-access',
                        'left' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 187,
                          'char' => 33,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'shares',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 187,
                          'char' => 40,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 187,
                        'char' => 40,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'normalizedName',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 187,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 187,
                      'char' => 57,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 187,
                    'char' => 57,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 187,
                  'char' => 57,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 187,
                'char' => 57,
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
                      'property' => 'shares',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'variable',
                          'value' => 'normalizedName',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 188,
                          'char' => 44,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'null',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 188,
                        'char' => 52,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 188,
                      'char' => 52,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 189,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 190,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 190,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 191,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * @param mixed nameOfInstance
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 182,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 182,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 182,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 196,
          'char' => 6,
        ),
        7 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'resolveAlias',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 197,
              'char' => 49,
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
                  'variable' => 'key',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 199,
                  'char' => 16,
                ),
                1 => 
                array (
                  'variable' => 'normalizedName',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 199,
                  'char' => 32,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 200,
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
                  'variable' => 'normalizedName',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 200,
                      'char' => 35,
                    ),
                    'name' => 'normalizeName',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 200,
                          'char' => 54,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 200,
                        'char' => 54,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 200,
                    'char' => 55,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 200,
                  'char' => 55,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 201,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'fetch',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'key',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 201,
                  'char' => 53,
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
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 201,
                      'char' => 28,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'aliases',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 201,
                      'char' => 36,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 201,
                    'char' => 36,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'normalizedName',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 201,
                    'char' => 51,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 201,
                  'char' => 53,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 201,
                'char' => 53,
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
                      'variable' => 'normalizedName',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 202,
                          'char' => 39,
                        ),
                        'name' => 'normalizeName',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'key',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 202,
                              'char' => 57,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 202,
                            'char' => 57,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 202,
                        'char' => 58,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 202,
                      'char' => 58,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 203,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 204,
              'char' => 14,
            ),
            3 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'array',
                'left' => 
                array (
                  0 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'variable',
                      'value' => 'name',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 204,
                      'char' => 21,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 204,
                    'char' => 21,
                  ),
                  1 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedName',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 204,
                      'char' => 37,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 204,
                    'char' => 37,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 204,
                'char' => 38,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 205,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * @param string name
     * @return array
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
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 198,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 198,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 210,
          'char' => 6,
        ),
        8 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'shareInstance',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'obj',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 211,
              'char' => 45,
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
                  'variable' => 'normalizedName',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 213,
                  'char' => 27,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 215,
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
                  'variable' => 'normalizedName',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 215,
                      'char' => 35,
                    ),
                    'name' => 'normalizeName',
                    'call-type' => 1,
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
                                'value' => 'obj',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 215,
                                'char' => 63,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 215,
                              'char' => 63,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 215,
                          'char' => 64,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 215,
                        'char' => 64,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 215,
                    'char' => 65,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 215,
                  'char' => 65,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 216,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'isset',
                'left' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 216,
                      'char' => 23,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'aliases',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 216,
                      'char' => 31,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 216,
                    'char' => 31,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'normalizedName',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 216,
                    'char' => 46,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 216,
                  'char' => 48,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 216,
                'char' => 48,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'fcall',
                          'name' => 'sprintf',
                          'call-type' => 1,
                          'parameters' => 
                          array (
                            0 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'array-access',
                                'left' => 
                                array (
                                  'type' => 'static-property-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 220,
                                    'char' => 40,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'errorMessages',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 220,
                                    'char' => 40,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 220,
                                  'char' => 40,
                                ),
                                'right' => 
                                array (
                                  'type' => 'static-constant-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 220,
                                    'char' => 69,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'E_ALIASED_CANNOT_SHARE',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 220,
                                    'char' => 69,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 220,
                                  'char' => 69,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 220,
                                'char' => 70,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 220,
                              'char' => 70,
                            ),
                            1 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'variable',
                                'value' => 'normalizedName',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 221,
                                'char' => 35,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 221,
                              'char' => 35,
                            ),
                            2 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'array-access',
                                'left' => 
                                array (
                                  'type' => 'property-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'this',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 222,
                                    'char' => 26,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'aliases',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 222,
                                    'char' => 34,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 222,
                                  'char' => 34,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'normalizedName',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 222,
                                  'char' => 49,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 223,
                                'char' => 17,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 223,
                              'char' => 17,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 223,
                          'char' => 18,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 223,
                        'char' => 18,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 225,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_ALIASED_CANNOT_SHARE',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 225,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 225,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 225,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 225,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 226,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 227,
              'char' => 11,
            ),
            3 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'shares',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedName',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 227,
                      'char' => 40,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'obj',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 227,
                    'char' => 47,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 227,
                  'char' => 47,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 229,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 229,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 230,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * @param mixed obj
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 212,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 212,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 212,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 241,
          'char' => 6,
        ),
        9 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'mutate',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 242,
              'char' => 40,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'callableOrMethodStr',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 242,
              'char' => 65,
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
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 244,
                  'char' => 18,
                ),
                1 => 
                array (
                  'variable' => 'normalizedName',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 244,
                  'char' => 34,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 246,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'mcall',
                  'variable' => 
                  array (
                    'type' => 'variable',
                    'value' => 'this',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 246,
                    'char' => 18,
                  ),
                  'name' => 'isInvokable',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'variable',
                        'value' => 'callableOrMethodStr',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 246,
                        'char' => 50,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 246,
                      'char' => 50,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 246,
                  'char' => 52,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 246,
                'char' => 52,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'static-property-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => 'self',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 248,
                              'char' => 36,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'errorMessages',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 248,
                              'char' => 36,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 248,
                            'char' => 36,
                          ),
                          'right' => 
                          array (
                            'type' => 'static-constant-access',
                            'left' => 
                            array (
                              'type' => 'variable',
                              'value' => 'self',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 248,
                              'char' => 54,
                            ),
                            'right' => 
                            array (
                              'type' => 'variable',
                              'value' => 'E_INVOKABLE',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 248,
                              'char' => 54,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 248,
                            'char' => 54,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 248,
                          'char' => 55,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 248,
                        'char' => 55,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 250,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_INVOKABLE',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 250,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 250,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 250,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 250,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 251,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 253,
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
                  'variable' => 'value',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 253,
                      'char' => 26,
                    ),
                    'name' => 'resolveAlias',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 253,
                          'char' => 44,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 253,
                        'char' => 44,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 253,
                    'char' => 45,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 253,
                  'char' => 45,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 254,
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
                  'variable' => 'normalizedName',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'end',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'value',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 254,
                          'char' => 39,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 254,
                        'char' => 39,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 254,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 254,
                  'char' => 40,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 255,
              'char' => 11,
            ),
            4 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'mutators',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedName',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 255,
                      'char' => 42,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'callableOrMethodStr',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 255,
                    'char' => 65,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 255,
                  'char' => 65,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 257,
              'char' => 14,
            ),
            5 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 257,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 258,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Register a mutator callable to modify/prepare objects of type $name after instantiation
     *
     * Any callable or provisionable invokable may be specified. Preparers are passed two
     * arguments: the instantiated object to be mutated and the current Injector instance.
     *
     * @param string name
     * @param mixed callableOrMethodStr Any callable or provisionable invokable method
     * @return \\Auryn\\ReflectorInterface
     *',
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 263,
          'char' => 6,
        ),
        10 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'isInvokable',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'exe',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 264,
              'char' => 43,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'exe',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 266,
                      'char' => 24,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 266,
                    'char' => 24,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'object',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 266,
                    'char' => 36,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 266,
                  'char' => 36,
                ),
                'right' => 
                array (
                  'type' => 'fcall',
                  'name' => 'is_callable',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'variable',
                        'value' => 'exe',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 266,
                        'char' => 53,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 266,
                      'char' => 53,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 266,
                  'char' => 55,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 266,
                'char' => 55,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'bool',
                    'value' => 'true',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 267,
                    'char' => 24,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 268,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 270,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'exe',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 270,
                      'char' => 24,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 270,
                    'char' => 24,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'string',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 270,
                    'char' => 36,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 270,
                  'char' => 36,
                ),
                'right' => 
                array (
                  'type' => 'fcall',
                  'name' => 'method_exists',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'variable',
                        'value' => 'exe',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 270,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 270,
                      'char' => 55,
                    ),
                    1 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'string',
                        'value' => '__invoke',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 270,
                        'char' => 67,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 270,
                      'char' => 67,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 270,
                  'char' => 69,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 270,
                'char' => 69,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'bool',
                    'value' => 'true',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 271,
                    'char' => 24,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 272,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 274,
              'char' => 10,
            ),
            2 => 
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
                    'value' => 'exe',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 274,
                    'char' => 24,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 274,
                  'char' => 24,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'array',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 274,
                  'char' => 34,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 274,
                'char' => 34,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'if',
                  'expr' => 
                  array (
                    'type' => 'isset',
                    'left' => 
                    array (
                      'type' => 'array-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'exe',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 275,
                        'char' => 25,
                      ),
                      'right' => 
                      array (
                        'type' => 'int',
                        'value' => '0',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 275,
                        'char' => 27,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 275,
                      'char' => 29,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 275,
                    'char' => 29,
                  ),
                  'statements' => 
                  array (
                    0 => 
                    array (
                      'type' => 'if',
                      'expr' => 
                      array (
                        'type' => 'isset',
                        'left' => 
                        array (
                          'type' => 'array-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'exe',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 276,
                            'char' => 29,
                          ),
                          'right' => 
                          array (
                            'type' => 'int',
                            'value' => '1',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 276,
                            'char' => 31,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 276,
                          'char' => 33,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 276,
                        'char' => 33,
                      ),
                      'statements' => 
                      array (
                        0 => 
                        array (
                          'type' => 'if',
                          'expr' => 
                          array (
                            'type' => 'fcall',
                            'name' => 'method_exists',
                            'call-type' => 1,
                            'parameters' => 
                            array (
                              0 => 
                              array (
                                'parameter' => 
                                array (
                                  'type' => 'array-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'exe',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 277,
                                    'char' => 41,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'int',
                                    'value' => '0',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 277,
                                    'char' => 43,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 277,
                                  'char' => 44,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 277,
                                'char' => 44,
                              ),
                              1 => 
                              array (
                                'parameter' => 
                                array (
                                  'type' => 'array-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'exe',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 277,
                                    'char' => 49,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'int',
                                    'value' => '1',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 277,
                                    'char' => 51,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 277,
                                  'char' => 52,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 277,
                                'char' => 52,
                              ),
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 277,
                            'char' => 54,
                          ),
                          'statements' => 
                          array (
                            0 => 
                            array (
                              'type' => 'return',
                              'expr' => 
                              array (
                                'type' => 'bool',
                                'value' => 'true',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 278,
                                'char' => 36,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 279,
                              'char' => 21,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 280,
                          'char' => 17,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 281,
                      'char' => 13,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 282,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 284,
              'char' => 14,
            ),
            3 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'bool',
                'value' => 'false',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 284,
                'char' => 21,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 285,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * @param mixed exe
     * @return boolean
     *',
          'return-type' => 
          array (
            'type' => 'return-type',
            'list' => 
            array (
              0 => 
              array (
                'type' => 'return-type-parameter',
                'data-type' => 'bool',
                'mandatory' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 265,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 265,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 293,
          'char' => 6,
        ),
        11 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'delegate',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 294,
              'char' => 42,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'callableOrMethodStr',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 294,
              'char' => 67,
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
                  'variable' => 'normalizedName',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 296,
                  'char' => 27,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 298,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'mcall',
                  'variable' => 
                  array (
                    'type' => 'variable',
                    'value' => 'this',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 298,
                    'char' => 18,
                  ),
                  'name' => 'isInvokable',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'variable',
                        'value' => 'callableOrMethodStr',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 298,
                        'char' => 50,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 298,
                      'char' => 50,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 298,
                  'char' => 52,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 298,
                'char' => 52,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'fcall',
                          'name' => 'sprintf',
                          'call-type' => 1,
                          'parameters' => 
                          array (
                            0 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'array-access',
                                'left' => 
                                array (
                                  'type' => 'static-property-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 300,
                                    'char' => 44,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'errorMessages',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 300,
                                    'char' => 44,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 300,
                                  'char' => 44,
                                ),
                                'right' => 
                                array (
                                  'type' => 'static-constant-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 300,
                                    'char' => 70,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'E_DELEGATE_ARGUMENT',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 300,
                                    'char' => 70,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 300,
                                  'char' => 70,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 300,
                                'char' => 71,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 300,
                              'char' => 71,
                            ),
                            1 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'constant',
                                'value' => '__CLASS__',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 300,
                                'char' => 82,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 300,
                              'char' => 82,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 300,
                          'char' => 83,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 300,
                        'char' => 83,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 302,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_DELEGATE_ARGUMENT',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 302,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 302,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 302,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 302,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 303,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 305,
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
                  'variable' => 'normalizedName',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 305,
                      'char' => 35,
                    ),
                    'name' => 'normalizeName',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 305,
                          'char' => 54,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 305,
                        'char' => 54,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 305,
                    'char' => 55,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 305,
                  'char' => 55,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 306,
              'char' => 11,
            ),
            3 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'delegates',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedName',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 306,
                      'char' => 43,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'callableOrMethodStr',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 306,
                    'char' => 66,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 306,
                  'char' => 66,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 308,
              'char' => 14,
            ),
            4 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'this',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 308,
                'char' => 20,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 309,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Delegate the creation of $name instances to the specified callable
     *
     * @param string name
     * @param mixed callableOrMethodStr Any callable or provisionable invokable method
     * @return \\Auryn\\ReflectorInterface
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
                  'value' => 'ReflectorInterface',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 295,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 295,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 295,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 319,
          'char' => 6,
        ),
        12 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'inspect',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'nameFilter',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 320,
                'char' => 54,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 320,
              'char' => 54,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'typeFilter',
              'const' => 0,
              'data-type' => 'int',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'null',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 320,
                'char' => 77,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 320,
              'char' => 77,
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
                  'variable' => 'result',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 322,
                  'char' => 19,
                ),
                1 => 
                array (
                  'variable' => 'name',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 322,
                  'char' => 25,
                ),
                2 => 
                array (
                  'variable' => 'elements',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 322,
                  'char' => 35,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 324,
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
                  'variable' => 'result',
                  'expr' => 
                  array (
                    'type' => 'empty-array',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 324,
                    'char' => 24,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 324,
                  'char' => 24,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 325,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not',
                'left' => 
                array (
                  'type' => 'empty',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'nameFilter',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 325,
                    'char' => 30,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 325,
                  'char' => 30,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 325,
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
                      'variable' => 'name',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 326,
                          'char' => 29,
                        ),
                        'name' => 'normalizeName',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'nameFilter',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 326,
                              'char' => 54,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 326,
                            'char' => 54,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 326,
                        'char' => 55,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 326,
                      'char' => 55,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 327,
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
                      'variable' => 'name',
                      'expr' => 
                      array (
                        'type' => 'null',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 328,
                        'char' => 28,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 328,
                      'char' => 28,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 329,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 331,
              'char' => 10,
            ),
            3 => 
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
                    'value' => 'typeFilter',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 331,
                    'char' => 31,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 331,
                  'char' => 31,
                ),
                'right' => 
                array (
                  'type' => 'string',
                  'value' => 'null',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 331,
                  'char' => 40,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 331,
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
                      'assign-type' => 'variable',
                      'operator' => 'assign',
                      'variable' => 'typeFilter',
                      'expr' => 
                      array (
                        'type' => 'static-constant-access',
                        'left' => 
                        array (
                          'type' => 'variable',
                          'value' => 'self',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 332,
                          'char' => 41,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'I_ALL',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 332,
                          'char' => 41,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 332,
                        'char' => 41,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 332,
                      'char' => 41,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 333,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 335,
              'char' => 11,
            ),
            4 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'elements',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 335,
                      'char' => 29,
                    ),
                    'name' => 'filter',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 335,
                            'char' => 42,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'bindings',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 335,
                            'char' => 51,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 335,
                          'char' => 51,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 335,
                        'char' => 51,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 335,
                          'char' => 57,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 335,
                        'char' => 57,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 335,
                    'char' => 58,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 335,
                  'char' => 58,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 336,
              'char' => 10,
            ),
            5 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'bitwise_and',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'typeFilter',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 336,
                      'char' => 24,
                    ),
                    'right' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 336,
                        'char' => 42,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'I_BINDINGS',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 336,
                        'char' => 42,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 336,
                      'char' => 42,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 336,
                    'char' => 42,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 336,
                  'char' => 45,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'elements',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 336,
                  'char' => 56,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 336,
                'char' => 56,
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
                      'assign-type' => 'array-index',
                      'operator' => 'assign',
                      'variable' => 'result',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 337,
                            'char' => 40,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'I_BINDINGS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 337,
                            'char' => 40,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 337,
                          'char' => 40,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'elements',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 337,
                        'char' => 52,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 337,
                      'char' => 52,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 338,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 340,
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
                  'variable' => 'elements',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 340,
                      'char' => 29,
                    ),
                    'name' => 'filter',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 340,
                            'char' => 42,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'delegates',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 340,
                            'char' => 52,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 340,
                          'char' => 52,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 340,
                        'char' => 52,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 340,
                          'char' => 58,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 340,
                        'char' => 58,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 340,
                    'char' => 59,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 340,
                  'char' => 59,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 341,
              'char' => 10,
            ),
            7 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'bitwise_and',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'typeFilter',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 341,
                      'char' => 24,
                    ),
                    'right' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 341,
                        'char' => 43,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'I_DELEGATES',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 341,
                        'char' => 43,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 341,
                      'char' => 43,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 341,
                    'char' => 43,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 341,
                  'char' => 46,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'elements',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 341,
                  'char' => 57,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 341,
                'char' => 57,
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
                      'assign-type' => 'array-index',
                      'operator' => 'assign',
                      'variable' => 'result',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 342,
                            'char' => 41,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'I_DELEGATES',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 342,
                            'char' => 41,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 342,
                          'char' => 41,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'elements',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 342,
                        'char' => 53,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 342,
                      'char' => 53,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 343,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 345,
              'char' => 11,
            ),
            8 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'elements',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 345,
                      'char' => 29,
                    ),
                    'name' => 'filter',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 345,
                            'char' => 42,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'mutators',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 345,
                            'char' => 51,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 345,
                          'char' => 51,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 345,
                        'char' => 51,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 345,
                          'char' => 57,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 345,
                        'char' => 57,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 345,
                    'char' => 58,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 345,
                  'char' => 58,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 346,
              'char' => 10,
            ),
            9 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'bitwise_and',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'typeFilter',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 346,
                      'char' => 24,
                    ),
                    'right' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 346,
                        'char' => 42,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'I_MUTATORS',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 346,
                        'char' => 42,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 346,
                      'char' => 42,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 346,
                    'char' => 42,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 346,
                  'char' => 45,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'elements',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 346,
                  'char' => 56,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 346,
                'char' => 56,
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
                      'assign-type' => 'array-index',
                      'operator' => 'assign',
                      'variable' => 'result',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 347,
                            'char' => 40,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'I_MUTATORS',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 347,
                            'char' => 40,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 347,
                          'char' => 40,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'elements',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 347,
                        'char' => 52,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 347,
                      'char' => 52,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 348,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 350,
              'char' => 11,
            ),
            10 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'elements',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 350,
                      'char' => 29,
                    ),
                    'name' => 'filter',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 350,
                            'char' => 42,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'aliases',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 350,
                            'char' => 50,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 350,
                          'char' => 50,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 350,
                        'char' => 50,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 350,
                          'char' => 56,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 350,
                        'char' => 56,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 350,
                    'char' => 57,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 350,
                  'char' => 57,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 351,
              'char' => 10,
            ),
            11 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'bitwise_and',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'typeFilter',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 351,
                      'char' => 24,
                    ),
                    'right' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 351,
                        'char' => 41,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'I_ALIASES',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 351,
                        'char' => 41,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 351,
                      'char' => 41,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 351,
                    'char' => 41,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 351,
                  'char' => 44,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'elements',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 351,
                  'char' => 55,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 351,
                'char' => 55,
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
                      'assign-type' => 'array-index',
                      'operator' => 'assign',
                      'variable' => 'result',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 352,
                            'char' => 39,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'I_ALIASES',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 352,
                            'char' => 39,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 352,
                          'char' => 39,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'elements',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 352,
                        'char' => 51,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 352,
                      'char' => 51,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 353,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 355,
              'char' => 11,
            ),
            12 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'elements',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 355,
                      'char' => 29,
                    ),
                    'name' => 'filter',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 355,
                            'char' => 42,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'shares',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 355,
                            'char' => 49,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 355,
                          'char' => 49,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 355,
                        'char' => 49,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 355,
                          'char' => 55,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 355,
                        'char' => 55,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 355,
                    'char' => 56,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 355,
                  'char' => 56,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 356,
              'char' => 10,
            ),
            13 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'list',
                  'left' => 
                  array (
                    'type' => 'bitwise_and',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'typeFilter',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 356,
                      'char' => 24,
                    ),
                    'right' => 
                    array (
                      'type' => 'static-constant-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'self',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 356,
                        'char' => 40,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'I_SHARES',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 356,
                        'char' => 40,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 356,
                      'char' => 40,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 356,
                    'char' => 40,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 356,
                  'char' => 43,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'elements',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 356,
                  'char' => 54,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 356,
                'char' => 54,
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
                      'assign-type' => 'array-index',
                      'operator' => 'assign',
                      'variable' => 'result',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 357,
                            'char' => 38,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'I_SHARES',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 357,
                            'char' => 38,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 357,
                          'char' => 38,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'elements',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 357,
                        'char' => 50,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 357,
                      'char' => 50,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 358,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 360,
              'char' => 14,
            ),
            14 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'result',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 360,
                'char' => 22,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 361,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Retrieve stored data for the specified definition type
     *
     * Exposes introspection of existing binds/delegates/shares/etc. for decoration and composition.
     *
     * @param string nameFilter An optional class name filter
     * @param int typeFilter A bitmask of Injector::* type constant flags
     * @return array
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
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 321,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 321,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 363,
          'char' => 13,
        ),
        13 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'filter',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'source',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 363,
              'char' => 41,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 363,
              'char' => 55,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'empty',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'name',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 365,
                  'char' => 23,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 365,
                'char' => 23,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'variable',
                    'value' => 'source',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 366,
                    'char' => 26,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 367,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 368,
              'char' => 10,
            ),
            1 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'isset',
                'left' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'source',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 368,
                    'char' => 24,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'name',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 368,
                    'char' => 29,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 368,
                  'char' => 31,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 368,
                'char' => 31,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'source',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 369,
                      'char' => 26,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'name',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 369,
                      'char' => 31,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 369,
                    'char' => 32,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 370,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 371,
              'char' => 14,
            ),
            2 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'empty-array',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 371,
                'char' => 18,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 372,
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
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 364,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 364,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 381,
          'char' => 6,
        ),
        14 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'make',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'name',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 1,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 382,
              'char' => 38,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'args',
              'const' => 0,
              'data-type' => 'array',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'empty-array',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 382,
                'char' => 55,
              ),
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 382,
              'char' => 55,
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
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 384,
                  'char' => 22,
                ),
                1 => 
                array (
                  'variable' => 'normalizedClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 384,
                  'char' => 39,
                ),
                2 => 
                array (
                  'variable' => 'invokable',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 384,
                  'char' => 50,
                ),
                3 => 
                array (
                  'variable' => 'obj',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 384,
                  'char' => 55,
                ),
                4 => 
                array (
                  'variable' => 'resolvedAlias',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 384,
                  'char' => 70,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 386,
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
                  'variable' => 'resolvedAlias',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 386,
                      'char' => 34,
                    ),
                    'name' => 'resolveAlias',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 386,
                          'char' => 52,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 386,
                        'char' => 52,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 386,
                    'char' => 53,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 386,
                  'char' => 53,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 387,
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
                  'variable' => 'className',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'resolvedAlias',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 387,
                      'char' => 38,
                    ),
                    'right' => 
                    array (
                      'type' => 'int',
                      'value' => '0',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 387,
                      'char' => 40,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 387,
                    'char' => 41,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 387,
                  'char' => 41,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 388,
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
                  'variable' => 'normalizedClass',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'resolvedAlias',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 388,
                      'char' => 44,
                    ),
                    'right' => 
                    array (
                      'type' => 'int',
                      'value' => '1',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 388,
                      'char' => 46,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 388,
                    'char' => 47,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 388,
                  'char' => 47,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 390,
              'char' => 10,
            ),
            4 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'isset',
                'left' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 390,
                      'char' => 23,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'inProgress',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 390,
                      'char' => 34,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 390,
                    'char' => 34,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'normalizedClass',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 390,
                    'char' => 50,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 390,
                  'char' => 52,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 390,
                'char' => 52,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'throw',
                  'expr' => 
                  array (
                    'type' => 'new',
                    'class' => 'InjectorException',
                    'dynamic' => 0,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'fcall',
                          'name' => 'sprintf',
                          'call-type' => 1,
                          'parameters' => 
                          array (
                            0 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'array-access',
                                'left' => 
                                array (
                                  'type' => 'static-property-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 393,
                                    'char' => 40,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'errorMessages',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 393,
                                    'char' => 40,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 393,
                                  'char' => 40,
                                ),
                                'right' => 
                                array (
                                  'type' => 'static-constant-access',
                                  'left' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'self',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 393,
                                    'char' => 66,
                                  ),
                                  'right' => 
                                  array (
                                    'type' => 'variable',
                                    'value' => 'E_CYCLIC_DEPENDENCY',
                                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                    'line' => 393,
                                    'char' => 66,
                                  ),
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 393,
                                  'char' => 66,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 393,
                                'char' => 67,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 393,
                              'char' => 67,
                            ),
                            1 => 
                            array (
                              'parameter' => 
                              array (
                                'type' => 'variable',
                                'value' => 'className',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 395,
                                'char' => 17,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 395,
                              'char' => 17,
                            ),
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 395,
                          'char' => 18,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 395,
                        'char' => 18,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'static-constant-access',
                          'left' => 
                          array (
                            'type' => 'variable',
                            'value' => 'self',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 397,
                            'char' => 13,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'E_CYCLIC_DEPENDENCY',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 397,
                            'char' => 13,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 397,
                          'char' => 13,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 397,
                        'char' => 13,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 397,
                    'char' => 14,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 398,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 400,
              'char' => 11,
            ),
            5 => 
            array (
              'type' => 'let',
              'assignments' => 
              array (
                0 => 
                array (
                  'assign-type' => 'object-property-array-index',
                  'operator' => 'assign',
                  'variable' => 'this',
                  'property' => 'inProgress',
                  'index-expr' => 
                  array (
                    0 => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedClass',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 400,
                      'char' => 45,
                    ),
                  ),
                  'expr' => 
                  array (
                    'type' => 'bool',
                    'value' => 'true',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 400,
                    'char' => 53,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 400,
                  'char' => 53,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 405,
              'char' => 10,
            ),
            6 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'isset',
                'left' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 405,
                      'char' => 23,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'shares',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 405,
                      'char' => 30,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 405,
                    'char' => 30,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'normalizedClass',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 405,
                    'char' => 46,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 405,
                  'char' => 48,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 405,
                'char' => 48,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'unset',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 406,
                        'char' => 24,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'inProgress',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 406,
                        'char' => 35,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 406,
                      'char' => 35,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedClass',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 406,
                      'char' => 51,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 406,
                    'char' => 52,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 408,
                  'char' => 18,
                ),
                1 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 408,
                        'char' => 25,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'shares',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 408,
                        'char' => 32,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 408,
                      'char' => 32,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedClass',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 408,
                      'char' => 48,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 408,
                    'char' => 49,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 409,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 411,
              'char' => 10,
            ),
            7 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'isset',
                'left' => 
                array (
                  'type' => 'array-access',
                  'left' => 
                  array (
                    'type' => 'property-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 411,
                      'char' => 23,
                    ),
                    'right' => 
                    array (
                      'type' => 'variable',
                      'value' => 'delegates',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 411,
                      'char' => 33,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 411,
                    'char' => 33,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'normalizedClass',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 411,
                    'char' => 49,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 411,
                  'char' => 51,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 411,
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
                      'variable' => 'invokable',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 412,
                          'char' => 34,
                        ),
                        'name' => 'makeInvokable',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array-access',
                              'left' => 
                              array (
                                'type' => 'property-access',
                                'left' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'this',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 412,
                                  'char' => 54,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'delegates',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 412,
                                  'char' => 64,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 412,
                                'char' => 64,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'normalizedClass',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 412,
                                'char' => 80,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 412,
                              'char' => 81,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 412,
                            'char' => 81,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 412,
                        'char' => 82,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 412,
                      'char' => 82,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 413,
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
                      'variable' => 'obj',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'invokable',
                        'call-type' => 2,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'className',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 413,
                              'char' => 44,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 413,
                            'char' => 44,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'this',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 413,
                              'char' => 50,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 413,
                            'char' => 50,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 413,
                        'char' => 51,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 413,
                      'char' => 51,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 414,
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
                      'variable' => 'obj',
                      'expr' => 
                      array (
                        'type' => 'mcall',
                        'variable' => 
                        array (
                          'type' => 'variable',
                          'value' => 'this',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 415,
                          'char' => 28,
                        ),
                        'name' => 'provisionInstance',
                        'call-type' => 3,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'className',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 415,
                              'char' => 60,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 415,
                            'char' => 60,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'normalizedClass',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 415,
                              'char' => 77,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 415,
                            'char' => 77,
                          ),
                          2 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'args',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 415,
                              'char' => 83,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 415,
                            'char' => 83,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 415,
                        'char' => 84,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 415,
                      'char' => 84,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 416,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 418,
              'char' => 10,
            ),
            8 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'fcall',
                'name' => 'array_key_exists',
                'call-type' => 1,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedClass',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 418,
                      'char' => 44,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 418,
                    'char' => 44,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'property-access',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 418,
                        'char' => 51,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'shares',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 418,
                        'char' => 58,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 418,
                      'char' => 58,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 418,
                    'char' => 58,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 418,
                'char' => 60,
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
                      'property' => 'shares',
                      'index-expr' => 
                      array (
                        0 => 
                        array (
                          'type' => 'variable',
                          'value' => 'normalizedClass',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 419,
                          'char' => 45,
                        ),
                      ),
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'obj',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 419,
                        'char' => 52,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 419,
                      'char' => 52,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 420,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 422,
              'char' => 12,
            ),
            9 => 
            array (
              'type' => 'mcall',
              'expr' => 
              array (
                'type' => 'mcall',
                'variable' => 
                array (
                  'type' => 'variable',
                  'value' => 'this',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 422,
                  'char' => 14,
                ),
                'name' => 'mutateInstance',
                'call-type' => 3,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'obj',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 422,
                      'char' => 37,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 422,
                    'char' => 37,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'normalizedClass',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 422,
                      'char' => 54,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 422,
                    'char' => 54,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 422,
                'char' => 55,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 424,
              'char' => 13,
            ),
            10 => 
            array (
              'type' => 'unset',
              'expr' => 
              array (
                'type' => 'array-access',
                'left' => 
                array (
                  'type' => 'property-access',
                  'left' => 
                  array (
                    'type' => 'variable',
                    'value' => 'this',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 424,
                    'char' => 20,
                  ),
                  'right' => 
                  array (
                    'type' => 'variable',
                    'value' => 'inProgress',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 424,
                    'char' => 31,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 424,
                  'char' => 31,
                ),
                'right' => 
                array (
                  'type' => 'variable',
                  'value' => 'normalizedClass',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 424,
                  'char' => 47,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 424,
                'char' => 48,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 426,
              'char' => 14,
            ),
            11 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'obj',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 426,
                'char' => 19,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 427,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Instantiate/provision a class instance
     *
     * @param string name
     * @param array args
     * @return mixed
     * @TODO fix call to provisionInstance
     *',
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 444,
          'char' => 6,
        ),
        15 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => 'makeInvokable',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'callableOrMethodStr',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 445,
              'char' => 54,
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
                  'variable' => 'invokables',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 447,
                  'char' => 23,
                ),
                1 => 
                array (
                  'variable' => 'reflFunc',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 447,
                  'char' => 33,
                ),
                2 => 
                array (
                  'variable' => 'invocationObj',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 447,
                  'char' => 48,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 449,
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
                  'variable' => 'invokables',
                  'expr' => 
                  array (
                    'type' => 'mcall',
                    'variable' => 
                    array (
                      'type' => 'variable',
                      'value' => 'this',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 449,
                      'char' => 31,
                    ),
                    'name' => 'generateInvokables',
                    'call-type' => 3,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'callableOrMethodStr',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 449,
                          'char' => 74,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 449,
                        'char' => 74,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 449,
                    'char' => 75,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 449,
                  'char' => 75,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 450,
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
                  'variable' => 'reflFunc',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'invokables',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 450,
                      'char' => 34,
                    ),
                    'right' => 
                    array (
                      'type' => 'int',
                      'value' => '0',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 450,
                      'char' => 36,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 450,
                    'char' => 37,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 450,
                  'char' => 37,
                ),
                1 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'invocationObj',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'invokables',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 450,
                      'char' => 65,
                    ),
                    'right' => 
                    array (
                      'type' => 'int',
                      'value' => '1',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 450,
                      'char' => 67,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 450,
                    'char' => 68,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 450,
                  'char' => 68,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 452,
              'char' => 14,
            ),
            3 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'new',
                'class' => 'Invokable',
                'dynamic' => 0,
                'parameters' => 
                array (
                  0 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'reflFunc',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 452,
                      'char' => 38,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 452,
                    'char' => 38,
                  ),
                  1 => 
                  array (
                    'parameter' => 
                    array (
                      'type' => 'variable',
                      'value' => 'invocationObj',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 452,
                      'char' => 53,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 452,
                    'char' => 53,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 452,
                'char' => 54,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 453,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Provision an Invokable instance from any valid callable or class/method string
     *
     * @param mixed $callableOrMethodStr A valid PHP callable or a provisionable ClassName::methodName string
     * @return \\Auryn\\Invokable
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
                  'value' => 'Invokable',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 446,
                  'char' => 5,
                ),
                'collection' => 0,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 446,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 446,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 458,
          'char' => 13,
        ),
        16 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'generateStringClassMethodCallable',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'className',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 458,
              'char' => 67,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'method',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 458,
              'char' => 75,
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
                  'variable' => 'relativeStaticMethodStartPos',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 460,
                  'char' => 41,
                ),
                1 => 
                array (
                  'variable' => 'childReflection',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 460,
                  'char' => 58,
                ),
                2 => 
                array (
                  'variable' => 'reflectionMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 460,
                  'char' => 76,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 462,
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
                  'variable' => 'relativeStaticMethodStartPos',
                  'expr' => 
                  array (
                    'type' => 'fcall',
                    'name' => 'strpos',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'method',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 462,
                          'char' => 57,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 462,
                        'char' => 57,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'string',
                          'value' => 'parent::',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 462,
                          'char' => 69,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 462,
                        'char' => 69,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 462,
                    'char' => 70,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 462,
                  'char' => 70,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 464,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'equals',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'relativeStaticMethodStartPos',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 464,
                  'char' => 42,
                ),
                'right' => 
                array (
                  'type' => 'int',
                  'value' => '0',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 464,
                  'char' => 46,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 464,
                'char' => 46,
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
                      'variable' => 'childReflection',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 465,
                            'char' => 40,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'reflector',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 465,
                            'char' => 51,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 465,
                          'char' => 51,
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
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 465,
                              'char' => 70,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 465,
                            'char' => 70,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 465,
                        'char' => 71,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 465,
                      'char' => 71,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 466,
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
                      'variable' => 'className',
                      'expr' => 
                      array (
                        'type' => 'property-access',
                        'left' => 
                        array (
                          'type' => 'mcall',
                          'variable' => 
                          array (
                            'type' => 'variable',
                            'value' => 'childReflection',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 466,
                            'char' => 45,
                          ),
                          'name' => 'getParentClass',
                          'call-type' => 1,
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 466,
                          'char' => 63,
                        ),
                        'right' => 
                        array (
                          'type' => 'variable',
                          'value' => 'name',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 466,
                          'char' => 68,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 466,
                        'char' => 68,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 466,
                      'char' => 68,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 467,
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
                      'variable' => 'method',
                      'expr' => 
                      array (
                        'type' => 'fcall',
                        'name' => 'substr',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'method',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 467,
                              'char' => 39,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 467,
                            'char' => 39,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'add',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'relativeStaticMethodStartPos',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 467,
                                'char' => 70,
                              ),
                              'right' => 
                              array (
                                'type' => 'int',
                                'value' => '8',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 467,
                                'char' => 73,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 467,
                              'char' => 73,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 467,
                            'char' => 73,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 467,
                        'char' => 74,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 467,
                      'char' => 74,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 468,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 470,
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
                  'variable' => 'reflectionMethod',
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
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 470,
                        'char' => 37,
                      ),
                      'right' => 
                      array (
                        'type' => 'variable',
                        'value' => 'reflector',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 470,
                        'char' => 48,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 470,
                      'char' => 48,
                    ),
                    'name' => 'getMethod',
                    'call-type' => 1,
                    'parameters' => 
                    array (
                      0 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'className',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 470,
                          'char' => 68,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 470,
                        'char' => 68,
                      ),
                      1 => 
                      array (
                        'parameter' => 
                        array (
                          'type' => 'variable',
                          'value' => 'method',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 470,
                          'char' => 76,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 470,
                        'char' => 76,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 470,
                    'char' => 77,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 470,
                  'char' => 77,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 472,
              'char' => 10,
            ),
            4 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'mcall',
                'variable' => 
                array (
                  'type' => 'variable',
                  'value' => 'reflectionMethod',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 472,
                  'char' => 29,
                ),
                'name' => 'isStatic',
                'call-type' => 1,
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 472,
                'char' => 41,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'return',
                  'expr' => 
                  array (
                    'type' => 'array',
                    'left' => 
                    array (
                      0 => 
                      array (
                        'value' => 
                        array (
                          'type' => 'variable',
                          'value' => 'reflectionMethod',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 473,
                          'char' => 37,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 473,
                        'char' => 37,
                      ),
                      1 => 
                      array (
                        'value' => 
                        array (
                          'type' => 'null',
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 473,
                          'char' => 43,
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 473,
                        'char' => 43,
                      ),
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 473,
                    'char' => 44,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 474,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 475,
              'char' => 14,
            ),
            5 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'array',
                'left' => 
                array (
                  0 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'variable',
                      'value' => 'reflectionMethod',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 475,
                      'char' => 33,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 475,
                    'char' => 33,
                  ),
                  1 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'mcall',
                      'variable' => 
                      array (
                        'type' => 'variable',
                        'value' => 'this',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 475,
                        'char' => 40,
                      ),
                      'name' => 'make',
                      'call-type' => 1,
                      'parameters' => 
                      array (
                        0 => 
                        array (
                          'parameter' => 
                          array (
                            'type' => 'variable',
                            'value' => 'className',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 475,
                            'char' => 55,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 475,
                          'char' => 55,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 475,
                      'char' => 56,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 475,
                    'char' => 56,
                  ),
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 475,
                'char' => 57,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 476,
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
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 459,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 459,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 478,
          'char' => 13,
        ),
        17 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'method',
          'name' => 'generateInvokablesFromArray',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'arrayInvokable',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'reference' => 0,
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 478,
              'char' => 70,
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
                  'variable' => 'classOrObj',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 480,
                  'char' => 23,
                ),
                1 => 
                array (
                  'variable' => 'method',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 480,
                  'char' => 31,
                ),
                2 => 
                array (
                  'variable' => 'callableRefl',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 480,
                  'char' => 45,
                ),
                3 => 
                array (
                  'variable' => 'invokableArr',
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 480,
                  'char' => 59,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 482,
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
                  'variable' => 'classOrObj',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'arrayInvokable',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 482,
                      'char' => 40,
                    ),
                    'right' => 
                    array (
                      'type' => 'int',
                      'value' => '0',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 482,
                      'char' => 42,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 482,
                    'char' => 43,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 482,
                  'char' => 43,
                ),
                1 => 
                array (
                  'assign-type' => 'variable',
                  'operator' => 'assign',
                  'variable' => 'method',
                  'expr' => 
                  array (
                    'type' => 'array-access',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'arrayInvokable',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 482,
                      'char' => 68,
                    ),
                    'right' => 
                    array (
                      'type' => 'int',
                      'value' => '1',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 482,
                      'char' => 70,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 482,
                    'char' => 71,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 482,
                  'char' => 71,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 484,
              'char' => 10,
            ),
            2 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'and',
                'left' => 
                array (
                  'type' => 'equals',
                  'left' => 
                  array (
                    'type' => 'typeof',
                    'left' => 
                    array (
                      'type' => 'variable',
                      'value' => 'classOrObj',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 484,
                      'char' => 31,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 484,
                    'char' => 31,
                  ),
                  'right' => 
                  array (
                    'type' => 'string',
                    'value' => 'object',
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 484,
                    'char' => 43,
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 484,
                  'char' => 43,
                ),
                'right' => 
                array (
                  'type' => 'fcall',
                  'name' => 'method_exists',
                  'call-type' => 1,
                  'parameters' => 
                  array (
                    0 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'variable',
                        'value' => 'classOrObj',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 484,
                        'char' => 69,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 484,
                      'char' => 69,
                    ),
                    1 => 
                    array (
                      'parameter' => 
                      array (
                        'type' => 'variable',
                        'value' => 'method',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 484,
                        'char' => 77,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 484,
                      'char' => 77,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 484,
                  'char' => 79,
                ),
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 484,
                'char' => 79,
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
                      'variable' => 'callableRefl',
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
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 485,
                            'char' => 37,
                          ),
                          'right' => 
                          array (
                            'type' => 'variable',
                            'value' => 'reflector',
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 485,
                            'char' => 48,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 485,
                          'char' => 48,
                        ),
                        'name' => 'getMethod',
                        'call-type' => 1,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'classOrObj',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 485,
                              'char' => 69,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 485,
                            'char' => 69,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'variable',
                              'value' => 'method',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 485,
                              'char' => 77,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 485,
                            'char' => 77,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 485,
                        'char' => 78,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 485,
                      'char' => 78,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 486,
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
                      'variable' => 'invokableArr',
                      'expr' => 
                      array (
                        'type' => 'array',
                        'left' => 
                        array (
                          0 => 
                          array (
                            'value' => 
                            array (
                              'type' => 'variable',
                              'value' => 'callableRefl',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 486,
                              'char' => 45,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 486,
                            'char' => 45,
                          ),
                          1 => 
                          array (
                            'value' => 
                            array (
                              'type' => 'variable',
                              'value' => 'classOrObj',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 486,
                              'char' => 57,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 486,
                            'char' => 57,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 486,
                        'char' => 58,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 486,
                      'char' => 58,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 487,
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
                    'type' => 'equals',
                    'left' => 
                    array (
                      'type' => 'typeof',
                      'left' => 
                      array (
                        'type' => 'variable',
                        'value' => 'classOrObj',
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 488,
                        'char' => 35,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 488,
                      'char' => 35,
                    ),
                    'right' => 
                    array (
                      'type' => 'string',
                      'value' => 'string',
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 488,
                      'char' => 46,
                    ),
                    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                    'line' => 488,
                    'char' => 46,
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
                          'variable' => 'invokableArr',
                          'expr' => 
                          array (
                            'type' => 'mcall',
                            'variable' => 
                            array (
                              'type' => 'variable',
                              'value' => 'this',
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 489,
                              'char' => 41,
                            ),
                            'name' => 'generateStringClassMethodCallable',
                            'call-type' => 3,
                            'parameters' => 
                            array (
                              0 => 
                              array (
                                'parameter' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'classOrObj',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 489,
                                  'char' => 90,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 489,
                                'char' => 90,
                              ),
                              1 => 
                              array (
                                'parameter' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'method',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 489,
                                  'char' => 98,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 489,
                                'char' => 98,
                              ),
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 489,
                            'char' => 99,
                          ),
                          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                          'line' => 489,
                          'char' => 99,
                        ),
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 490,
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
                        'class' => 'InjectorException',
                        'dynamic' => 0,
                        'parameters' => 
                        array (
                          0 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'array-access',
                              'left' => 
                              array (
                                'type' => 'static-property-access',
                                'left' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'self',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 491,
                                  'char' => 64,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'errorMessages',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 491,
                                  'char' => 64,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 491,
                                'char' => 64,
                              ),
                              'right' => 
                              array (
                                'type' => 'static-constant-access',
                                'left' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'self',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 491,
                                  'char' => 82,
                                ),
                                'right' => 
                                array (
                                  'type' => 'variable',
                                  'value' => 'E_INVOKABLE',
                                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                  'line' => 491,
                                  'char' => 82,
                                ),
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 491,
                                'char' => 82,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 491,
                              'char' => 83,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 491,
                            'char' => 83,
                          ),
                          1 => 
                          array (
                            'parameter' => 
                            array (
                              'type' => 'static-constant-access',
                              'left' => 
                              array (
                                'type' => 'variable',
                                'value' => 'self',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 491,
                                'char' => 102,
                              ),
                              'right' => 
                              array (
                                'type' => 'variable',
                                'value' => 'E_INVOKABLE',
                                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                                'line' => 491,
                                'char' => 102,
                              ),
                              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                              'line' => 491,
                              'char' => 102,
                            ),
                            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                            'line' => 491,
                            'char' => 102,
                          ),
                        ),
                        'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                        'line' => 491,
                        'char' => 103,
                      ),
                      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                      'line' => 492,
                      'char' => 13,
                    ),
                  ),
                  'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                  'line' => 493,
                  'char' => 9,
                ),
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 495,
              'char' => 14,
            ),
            3 => 
            array (
              'type' => 'return',
              'expr' => 
              array (
                'type' => 'variable',
                'value' => 'invokableArr',
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 495,
                'char' => 28,
              ),
              'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
              'line' => 496,
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
                'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
                'line' => 479,
                'char' => 5,
              ),
            ),
            'void' => 0,
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 479,
            'char' => 5,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 497,
          'char' => 1,
        ),
      ),
      'constants' => 
      array (
        0 => 
        array (
          'type' => 'const',
          'name' => 'A_CLASS',
          'default' => 
          array (
            'type' => 'string',
            'value' => ':',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 6,
            'char' => 24,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 7,
          'char' => 9,
        ),
        1 => 
        array (
          'type' => 'const',
          'name' => 'A_DELEGATE',
          'default' => 
          array (
            'type' => 'string',
            'value' => '+',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 7,
            'char' => 27,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 8,
          'char' => 9,
        ),
        2 => 
        array (
          'type' => 'const',
          'name' => 'A_DEFINE',
          'default' => 
          array (
            'type' => 'string',
            'value' => '@',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 8,
            'char' => 25,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 9,
          'char' => 9,
        ),
        3 => 
        array (
          'type' => 'const',
          'name' => 'I_BINDINGS',
          'default' => 
          array (
            'type' => 'int',
            'value' => '1',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 9,
            'char' => 25,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 10,
          'char' => 9,
        ),
        4 => 
        array (
          'type' => 'const',
          'name' => 'I_DELEGATES',
          'default' => 
          array (
            'type' => 'int',
            'value' => '2',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 10,
            'char' => 26,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 11,
          'char' => 9,
        ),
        5 => 
        array (
          'type' => 'const',
          'name' => 'I_MUTATORS',
          'default' => 
          array (
            'type' => 'int',
            'value' => '4',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 11,
            'char' => 25,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 12,
          'char' => 9,
        ),
        6 => 
        array (
          'type' => 'const',
          'name' => 'I_ALIASES',
          'default' => 
          array (
            'type' => 'int',
            'value' => '8',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 12,
            'char' => 24,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 13,
          'char' => 9,
        ),
        7 => 
        array (
          'type' => 'const',
          'name' => 'I_SHARES',
          'default' => 
          array (
            'type' => 'int',
            'value' => '16',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 13,
            'char' => 24,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 14,
          'char' => 9,
        ),
        8 => 
        array (
          'type' => 'const',
          'name' => 'I_ALL',
          'default' => 
          array (
            'type' => 'int',
            'value' => '17',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 14,
            'char' => 21,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 15,
          'char' => 9,
        ),
        9 => 
        array (
          'type' => 'const',
          'name' => 'E_NON_EMPTY_STRING_ALIAS',
          'default' => 
          array (
            'type' => 'int',
            'value' => '1',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 15,
            'char' => 39,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 16,
          'char' => 9,
        ),
        10 => 
        array (
          'type' => 'const',
          'name' => 'E_SHARED_CANNOT_ALIAS',
          'default' => 
          array (
            'type' => 'int',
            'value' => '2',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 16,
            'char' => 36,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 17,
          'char' => 9,
        ),
        11 => 
        array (
          'type' => 'const',
          'name' => 'E_SHARE_ARGUMENT',
          'default' => 
          array (
            'type' => 'int',
            'value' => '3',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 17,
            'char' => 31,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 18,
          'char' => 9,
        ),
        12 => 
        array (
          'type' => 'const',
          'name' => 'E_ALIASED_CANNOT_SHARE',
          'default' => 
          array (
            'type' => 'int',
            'value' => '4',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 18,
            'char' => 37,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 19,
          'char' => 9,
        ),
        13 => 
        array (
          'type' => 'const',
          'name' => 'E_INVOKABLE',
          'default' => 
          array (
            'type' => 'int',
            'value' => '5',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 19,
            'char' => 26,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 20,
          'char' => 9,
        ),
        14 => 
        array (
          'type' => 'const',
          'name' => 'E_NON_PUBLIC_CONSTRUCTOR',
          'default' => 
          array (
            'type' => 'int',
            'value' => '6',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 20,
            'char' => 39,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 21,
          'char' => 9,
        ),
        15 => 
        array (
          'type' => 'const',
          'name' => 'E_NEEDS_DEFINITION',
          'default' => 
          array (
            'type' => 'int',
            'value' => '7',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 21,
            'char' => 33,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 22,
          'char' => 9,
        ),
        16 => 
        array (
          'type' => 'const',
          'name' => 'E_MAKE_FAILURE',
          'default' => 
          array (
            'type' => 'int',
            'value' => '8',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 22,
            'char' => 29,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 23,
          'char' => 9,
        ),
        17 => 
        array (
          'type' => 'const',
          'name' => 'E_UNDEFINED_PARAM',
          'default' => 
          array (
            'type' => 'int',
            'value' => '9',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 23,
            'char' => 32,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 24,
          'char' => 9,
        ),
        18 => 
        array (
          'type' => 'const',
          'name' => 'E_DELEGATE_ARGUMENT',
          'default' => 
          array (
            'type' => 'int',
            'value' => '10',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 24,
            'char' => 35,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 25,
          'char' => 9,
        ),
        19 => 
        array (
          'type' => 'const',
          'name' => 'E_CYCLIC_DEPENDENCY',
          'default' => 
          array (
            'type' => 'int',
            'value' => '11',
            'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
            'line' => 25,
            'char' => 35,
          ),
          'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
          'line' => 27,
          'char' => 13,
        ),
      ),
      'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
      'line' => 497,
      'char' => 1,
    ),
    'file' => '/web/vendor/Auryn/ext/auryn/abstractinjector.zep',
    'line' => 498,
    'char' => 0,
  ),
);