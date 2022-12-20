
# Excluded features

Sometimes, you just have to say 'no'.

Although none of the features below would be ridiculous to include in this library, for various reasons they just haven't felt quite 'felt right' to include.

The notes below try to describe the feature, explain why it was not included, and suggest some alternative solutions.

## Lazy instantiation

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
