
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

Original discussion https://github.com/rdlowrey/auryn/issues/35

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





