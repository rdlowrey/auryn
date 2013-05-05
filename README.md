### WHAT IS IT?

# Auryn is a PHP Dependency Injection Container

Use Auryn to bootstrap and wire together S.O.L.I.D., object-oriented PHP applications. For help and
usage examples, check out the [**Auryn Wiki**](https://github.com/rdlowrey/Auryn/wiki).

### REQUIREMENTS

Auryn requires PHP5.3+

### INSTALL

You can download the latest version of Auryn from the git repository at any time:

```bash
$ git clone git://github.com/rdlowrey/Auryn.git
```

Additionally, archived tagged release versions are available for manual download on the Github project's
[Tags](https://github.com/rdlowrey/Auryn/tags) page.

You may also use composer to include Auryn as a dependency in your projects. The relevant package is:

*rdlowrey/auryn*

If you aren't using composer to manage dependencies, Auryn ships with an autoloader to simplify 
usage of the included libraries. Simply include this file to get started:

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
