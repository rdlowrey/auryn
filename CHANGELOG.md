v0.9.0
================================================================================
- Added `Injector::getExecutable()` for generating callables from any valid
  PHP callable or [class, method] array with full recursive provisioning and
  the option to get executable versions of protected/private methods.
- Shared aliases are now transparently returned (@Danack)
- Delegate callables now accept parameters (@leight)


#### v0.8.1
- Minor bugfixes

v0.8.0
================================================================================
- Shared concrete class aliases now resolved
- Minor bugfixes

v0.7.0
================================================================================
- Delegates are now automatically provisioned 
- New ProviderBuilder allows for populating injectors from an array, PHP or
  JSON file (@ascii-soup + @rdlowrey)
- Interfaces and abstract classes may now be delegated directly without the
  need for aliasing (@Danack)
- Exceptions thrown by the library have been streamlined


v0.6.0
================================================================================
- Parent definitions are now inherited by child classes (unless overridden)
  courtesy of @ascii-soup
- Fixed incompatibility with PHP5.3 -- credit: @ascii-soup


v0.5.0
================================================================================
- Added Injector::execute() method for recursively provisioning method
  signatures for all valid PHP callables.
- ReflectionMethod/ReflectionFunction objects are now cached
- Removed superfluous CachingReflectionStorage interface


v0.4.0
================================================================================
- Removed several "meta" methods deemed unnecessary. Simple > complex.


v0.3.0
================================================================================
- Added `hasDelegate` and `clearDelegate` methods to Injector API


#### v0.2.1
- Fixed syntax bug that manifested when checking if constructor types were
  instantiable.


v0.2.0
================================================================================
- Added ApcReflectionStorage for high-performance environments
- ReflectionStorage interface change for type-hint retrieval now requires
  the ReflectionMethod along with the ReflectionParameter for improved caching.


v0.1.0
================================================================================
- Initial release
