<?php


$finder = PhpCsFixer\Finder::create()
  ->in(__DIR__ . "/lib")
  ->in(__DIR__ . "/test");

$config = new PhpCsFixer\Config();

return $config
  ->setRules([
    '@PSR2' => true,
])
  ->setFinder($finder);
