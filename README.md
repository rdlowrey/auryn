# Auryn

Auryn is a PHP dependency injection container (DIC). Use Auryn to bootstrap and wire together
S.O.L.I.D., object-oriented PHP applications. For help and usage examples, check out the
[**Auryn Wiki**](https://github.com/rdlowrey/Auryn/wiki).

#### EXAMPLE

```php
<?php
class MyUniversalConfig {
    public $configVar = 'default config value';
}
class Dependency {}
class AnotherDependency {}
class Example {
    private $config;
    private $dep;
    function __construct(MyUniversalConfig $config, Dependency $dep){
        $this->config = $config;
        $this->dep = $dep;
    }
    function myMethod(AnotherDependency $anotherDep, $arg) {
        return "Config: {$this->config->configVar} | Scalar arg: {$arg}";
    }
}

$config = new MyUniversalConfig;
$injector = new Auryn\Provider;
$injector->share($config);
$config->configVar = 'altered value';

// outputs: "Config: altered value | Scalar arg: 42"
echo $injector->execute('Example::myMethod', $args = [':arg' => 42]);
```

#### REQUIREMENTS

- PHP 5.3+

#### INSTALL

##### Git:

```bash
$ git clone git://github.com/rdlowrey/Auryn.git
```

##### Manual Download:

[Tagged Releases](https://github.com/rdlowrey/Auryn/tags) page.

##### Composer:

```bash
$ composer.phar rdlowrey/auryn
```

#### AUTOLOADING

If you aren't using composer to manage dependencies, Auryn ships with an autoloader to simplify 
usage of the included libraries. Simply include the autoloader script to get started:

```php
<?php
require '/hard/path/to/auryn/autoload.php';
```

Auryn uses a PSR-0-compatible directory structure, so you can alternatively follow the usual PSR-0
loading practices:

```php
<?php
$loader = new SplClassLoader('Auryn', '/hard/path/to/auryn/src');
$loader->register();
```
