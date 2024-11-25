<?php

return (new \PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
    ])
    ->setFinder(
        (new \PhpCsFixer\Finder())
            ->in(__DIR__ . "/lib")
            ->in(__DIR__ . "/test")
    );
