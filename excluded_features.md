
# Excluded features

Sometimes, you just have to say 'no'.

Although none of the features below would be ridiculous to include in this library, for various reasons they just haven't felt quite 'felt right' to include.

The notes below try to describe the feature, explain why it was not included, and suggest some alternative solutions.

## Lazy instantiation

Original discussion: https://github.com/rdlowrey/auryn/issues/143

### Description

Some dependencies can be costly to create, either in terms of CPU time or memory, or both. 

If the dependency is not guaranteed to be used for all code paths then it can be worth delaying the initialization of that dependency until it is actually used.

### Alternative solution - use a factory

Instead of having a direct dependency on the class that is costly to create:

```php
class CostlyDependency {
    function do_the_needful() {
        ...
    }
}

class Foo {

    function __construct(private CostlyDependency $costlyDependency) {}
    
    function bar() {
        $this->costlyDependency->do_the_needful();
    } 
}
```

Create a factory class and depend on that instead, using it to create the costly dependency just before you know it's going to be used.

```php
class CostlyDependency {
 ...
}

class CostlyDependencyFactory {

    function __construct(private Injector $injector) {}

    function create(): CostlyDependency {
        return $this->injector->make(CostlyDependency::class);
    } 
}

class Foo {

    function __construct(private CostlyDependencyFactory $costlyDependencyFactory) {} 
    
    function bar() {
        $costlyDependency = $this->costlyDependencyFactory->create();
        $costlyDependency->do_the_needful();
    } 
}
```

And so that it is available to factory classes, in your bootstrap code share the injector:

```php
$injector->share($injector);
```

Although people frown on Service Locators, using the injector in a factory class is a fine tradeoff.

### Why Lazy Instantiation wasn't included

* Fewer dependencies is nicer. Having Auryn remain a library with zero external dependencies is nicer than having a non-trivial external dependency.
* Debugging problems inside the injector is a nightmare. Due to how complicated the call-stack is within the injector itself, it can be quite hard to understand what the problem is when an error occurs. By using a factory class, any problem should be a lot easier to debug.
* The alternative solution is trivial and better. In particular, it leaves the place where your code is going to have a costly instantiation of an object obvious, rather than it becoming hidden magic.


## Resolving dependencies based on constructor chain

Original discussion: https://github.com/rdlowrey/auryn/issues/35

### Description

Imagine you have two classes that each depend on a UtilityClass:

```php
interface Logger{}

class UtilityClass {
    function __construct(private Logger $logger) {}
    
    function foo() {
        $this->logger->log(Logger::info, "About to foo.");
    }
}

class ClassThatIsWorkingCorrectly{
    function __construct(UtilityClass $utilityClass) {}
}

class ClassRelatedToReportedBugs{
    function __construct(UtilityClass $utilityClass) {}
}
```

One of the classes is working correctly and you aren't interested in logging information it generates. The other class is misbehaving slightly.

Being able to configure the injector so that:

* the 'Logger' injected into most classes is a logger that only reports notices at the 'error' level.

* any 'Logger' created by 'ClassRelatedToReportedBugs' or any of its dependencies uses a Logger that reports notices at the 'info' level.

would allow you to manage your logging behaviour, so that your log files only contain relevant info.

### Alternative solutions

#### Get a more powerful logger or logging system

One example would be the `FingersCrossedHandler` listed in the [Monolog wiki](https://seldaek.github.io/monolog/doc/02-handlers-formatters-processors.html). It allows you to configure logging so that log messages are only actually logged if a certain triggering event has occurred.

Most hosted logging systems are quite powerful and can be configured in real-time, without having to touch the config of individual servers.

#### Use more contextual logging

Logging plain text is just not great. Due to it lacking structure, it makes it harder than it could be to filter, display and understand the logging information. Instead of logging plain text, logging structured data that other tools can understand programmatically makes understanding what is happening in your application much easier.

### Why it wasn't included

Mostly, it's just too much complexity for an injector. Although the complexity needs to live somewhere, it should be in the logger code and infrastructure, not in the injector.

Also, as only one person has requested this feature, it sounds like it shouldn't be included.


## Variadic dependencies

Original discussion: https://github.com/rdlowrey/auryn/issues/134

### Description

Sometimes, particularly when dealing with legacy code, you might have a dependency on multiple instances on the same type of object:

```php

interface Repository {
    function findInfo(): Info|null;
}

class Foo {
    public function __construct(Repository ...$repositories) {
        // ...
    }
}
```

Auryn does not support injecting variadic dependencies, so any class that has variadic dependencies cannot be directly instantiated by Auryn.

### Alternative solutions

#### Use a delegate method

The simplest work around is to use a delegate function for creating objects that have variadic dependencies: 

```php
function createFoo(RepositoryLocator $repoLocator)
{
    // Or whatever code is needed to find the repos.
    $repositories = $repoLocator->getRepos('Foo');

    return new Foo($repositories);
}

$injector->delegate('Foo', 'createFoo');
```

#### Use an object that collects the variadic dependencies

If you have many objects that have variadic dependencies, creating a separate delegate function for each of them might be a tedious task.

Instead of that, creating a single class that collects the variadic dependencies, and then can be injected through autowiring into other classes, could be substantially less work and also easier to understand.

```php
interface Repository {
    public function findInfo(): Info|null {} 
}

class RepositoryCollection {
    private $repos = [];

    public function __construct(Repository ...$repositories) {
        foreach ($repositories as $repo) {
            $this->repos[] =  $repo;
        }
    }

    public function findInfo(): Info|null {
        foreach ($this->repos as $repo) {
            $info = $repo->findInfo();
            if ($info !== null) {
                return $info;
            }
        }
        
        return null;
    }
} 

class Foo {
    public function __construct(RepositoryCollection $repositories) {
        // ...
    }
}

function createRepositoryCollection(RepositoryLocator $repoLocator)
{
    // Or whatever code is needed to find the repos.
    $repositories = $repoLocator->getRepos('Foo');

    return new Foo($repositories);
}

$injector->delegate(RepositoryCollection::class, 'createRepositoryCollection');

```

### Why support for variadic dependency  wasn't included

Variadics aren't a type and so can't be reasoned about by a dependency injector.

People should either use delegation or contexts to achieve what they're trying to do in a way that is comportable with dependency injection.

## Parameter definitions not inherited from parent classes

Original discussion: https://github.com/rdlowrey/auryn/issues/133

### Description

Some people expect classes to 'inherit' definitions when definitions exist for their parent class.

```php
class Foo
{
    public function __construct($key) { }
}

class Bar extends Foo
{
}

$injector = new Auryn\Injector;
$injector->define('Foo', [
    ':key' => 'secret',
]);

$foo_object = $injector->make(Foo::class);
$bar_object = $injector->make(Bar::class);

// Gives error:
// Uncaught Auryn\InjectionException: No definition available to provision
// typeless parameter $key at position 0 in Bar::__construct() declared in...
```

### Why support for parameter definitions are not inherited from parent classes

The choice for this library is that all configuration must be explicit, which helps make it easier to reason about the configuration.

If a class 'inherited' parameter definitions from a parent class, you would have to know that it had a parent class, and that a definition existed for that to be able to understand what parameters the object was going to receive.  

### Alternative solutions

#### Explicit definition

Just define parameters for each class that needs them.

```php
$injector->define('Foo', [':key' => 'secret']);
$injector->define('Bar', [':key' => 'secret']);
```

#### Wrap values in a type and share it

As types can be shared, that can avoid needing to define a scalar value multiple times.

```php
class ApiKey
{
    public function __construct(private string $value) {}

    public function getValue(): string
    {
        return $this->value;
    }
}

class Foo
{
    public function __construct(ApiKey $apiKey) { }
}

class Bar extends Foo
{
}

$injector = new Auryn\Injector;
$injector->share(new ApiKey('secret'));

$foo_object = $injector->make(Foo::class);
$bar_object = $injector->make(Bar::class);
```

## Resolve interfaces and abstracts to shared instances

Original discussion: https://github.com/rdlowrey/auryn/issues/145

### Description

Some people expect an injector to find classes that implement an interface whe

```php
interface A { }
class B implements A { }
class C {
    function __construct(A $a) { }
}

$b = new B();
$injector->share($b);

$injector->make(C::class);

// Gives error:
// Uncaught Auryn\InjectionException: Injection definition required for interface A in...
```

### Alternative solutions

Just define aliases for each interface to a concrete class. That will only take a few minutes per environment your code runs in.

### Why support for Resolve interfaces and abstracts to shared instances wasn't included

The choice for this library is that all configuration must be explicit, which helps make it easier to reason about the configuration.

If you wanted to see what class was going to be created for an interface, not being able to inspect the configuration of the injector, and instead having to either search through the code or run some test code would be 'ungood'. 

Additionally, if a second class that implements the interface was added, the injector would need to either pick one or throw an exception of "multiple available types". Either choice would be quite surprising and take more time to resolve than sim


