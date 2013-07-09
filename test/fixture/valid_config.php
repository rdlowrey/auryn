<?php

$aurynConfig = array(
    'definitions' => array(
        'RequiresInterface' => array(
            'dep' => 'DepImplementation'
        )
    ),
    'shares' => array(
        'RequiresInterface',
        'DepImplementation'
    ),
    'aliases' => array(
        'SomeInterface' => 'SomeImplementation'
    ),
    'delegates' => array(
        'SomeImplementation' => function() { return new SomeImplementation; }
    )
);
