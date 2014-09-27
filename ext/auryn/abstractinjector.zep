
namespace Auryn;

abstract class AbstractInjector
{
    const A_CLASS = ":";
    const A_DELEGATE = "+";
    const A_DEFINE = "@";
    const I_BINDINGS = 1;
    const I_DELEGATES = 2;
    const I_MUTATORS = 4;
    const I_ALIASES = 8;
    const I_SHARES = 16;
    const I_ALL = 17;
    const E_NON_EMPTY_STRING_ALIAS = 1;
    const E_SHARED_CANNOT_ALIAS = 2;
    const E_SHARE_ARGUMENT = 3;
    const E_ALIASED_CANNOT_SHARE = 4;
    const E_INVOKABLE = 5;
    const E_NON_PUBLIC_CONSTRUCTOR = 6;
    const E_NEEDS_DEFINITION = 7;
    const E_MAKE_FAILURE = 8;
    const E_UNDEFINED_PARAM = 9;
    const E_DELEGATE_ARGUMENT = 10;
    const E_CYCLIC_DEPENDENCY = 11;

    protected reflector;
    protected bindings = [];
    protected aliases = [];
    protected shares = [];
    protected mutators = [];
    protected delegates = [];
    protected paramDefinitions = [];
    protected inProgress = [];

    protected static errorMessages;

    public function __construct(<ReflectorInterface> reflector = null)
    {
        if unlikely typeof reflector == "null" {
            let this->reflector = new CachingReflector;
        } else {
            let this->reflector = reflector;
        }

        if unlikely empty self::errorMessages {
            let self::errorMessages[self::E_NON_EMPTY_STRING_ALIAS] = "Invalid alias: non-empty string required at both Argument 1 and Argument 2";
            let self::errorMessages[self::E_SHARED_CANNOT_ALIAS] = "Cannot alias class %s to %s: it is already shared";
            let self::errorMessages[self::E_SHARE_ARGUMENT] = "%s::share() requires a string class name or object instance at Argument 1; %s specified";
            let self::errorMessages[self::E_ALIASED_CANNOT_SHARE] = "Cannot share class %s, it has already been aliased to %s";
            let self::errorMessages[self::E_INVOKABLE] = "Invalid invokable: callable or provisional string required";
            let self::errorMessages[self::E_NON_PUBLIC_CONSTRUCTOR] = "Cannot instantiate class %s; constructor method is protected/private";
            let self::errorMessages[self::E_NEEDS_DEFINITION] = "Injection definition/implementation required for non-concrete parameter $%s of type %s";
            let self::errorMessages[self::E_MAKE_FAILURE] = "Could not make %s: %s";
            let self::errorMessages[self::E_UNDEFINED_PARAM] = "No definition available while attempting to provision typeless non-concrete parameter %s(%s)";
            let self::errorMessages[self::E_DELEGATE_ARGUMENT] = "%s::delegate expects a valid callable or provisionable executable class or method reference at Argument 2";
            let self::errorMessages[self::E_CYCLIC_DEPENDENCY] = "Detected a cyclic dependency while provisioning %s";
        }
    }

    /**
     * Bind instantiation directives for the specified class
     *
     * @param string name The class (or alias) whose constructor arguments we wish to bind
     * @param array args An array mapping parameter names to values/instructions
     * @return \Auryn\ReflectorInterface
     */
    public function bind(string! name, array args) -> <ReflectorInterface>
    {
        var value, normalizedName;
        let value = this->resolveAlias(name);
        let normalizedName = end(value);
        let this->bindings[normalizedName] = args;
        return this;
    }

    /**
     * Assign a global default value for all parameters named $paramName
     *
     * Global parameter definitions are only used for parameters with no typehint, pre-defined or
     * call-time definition.
     *
     * @param string paramName The parameter name for which this value applies
     * @param mixed value The value to inject for this parameter name
     * @return \Auryn\ReflectorInterface
     */
    public function bindParam(string! paramName, var value) -> <ReflectorInterface>
    {
        let this->paramDefinitions[paramName] = value;
        return this;
    }

    /**
     * Define an alias for all occurrences of a given typehint
     *
     * Use this method to specify implementation classes for interface and abstract class typehints.
     *
     * @param string original The typehint to replace
     * @param string alias The implementation name
     * @return \Auryn\ReflectorInterface
     */
    public function alias(string! original, string! alias) -> <ReflectorInterface>
    {
        var originalNormalized, aliasNormalized;

        if empty original || typeof original != "string" {
            throw new InjectorException(
                self::errorMessages[self::E_NON_EMPTY_STRING_ALIAS],
                self::E_NON_EMPTY_STRING_ALIAS
            );
        }

        if empty alias || typeof alias != "string" {
            throw new InjectorException(
                self::errorMessages[self::E_NON_EMPTY_STRING_ALIAS],
                self::E_NON_EMPTY_STRING_ALIAS
            );
        }

        let originalNormalized = this->normalizeName(original);

        if isset this->shares[originalNormalized] {
            throw new InjectorException(
                sprintf(
                    self::errorMessages[self::E_SHARED_CANNOT_ALIAS],
                    this->normalizeName(get_class(this->shares[originalNormalized])),
                    alias
                ),
                self::E_SHARED_CANNOT_ALIAS
            );
        }

        if array_key_exists($originalNormalized, this->shares) {
            let aliasNormalized = this->normalizeName(alias);
            let this->shares[aliasNormalized] = null;
            unset this->shares[originalNormalized];
        }

        let this->aliases[originalNormalized] = alias;

        return this;
    }

    protected function normalizeName(string! className) -> string
    {
        return ltrim(strtolower(className), "\\");
    }

    /**
     * Share the specified class/instance across the Injector context
     *
     * @param mixed $nameOrInstance The class or object to share
     * @return \Auryn\ReflectorInterface
     */
    public function share(var nameOrInstance) -> <ReflectorInterface>
    {
        if typeof nameOrInstance == "string" {
            this->shareClass(nameOrInstance);
        } else {
            if typeof nameOrInstance == "object" {
                this->shareInstance(nameOrInstance);
            } else {
                throw new InjectorException(
                    sprintf(
                        self::errorMessages[self::E_SHARE_ARGUMENT],
                        __CLASS__,
                        gettype(nameOrInstance)
                    ),
                    self::E_SHARE_ARGUMENT
                );
            }
        }

        return this;
    }

    /**
     * @param mixed nameOfInstance
     * @return \Auryn\ReflectorInterface
     */
    protected function shareClass(var nameOrInstance) -> <ReflectorInterface>
    {
        var value, normalizedName;
        let value = this->resolveAlias(nameOrInstance);
        let normalizedName = end(value);

        if !unlikely isset this->shares[normalizedName] {
            let this->shares[normalizedName] = null;
        }
        return this;
    }

    /**
     * @param string name
     * @return array
     */
    protected function resolveAlias(string! name) -> array
    {
        var key, normalizedName;
        let normalizedName = this->normalizeName(name);
        if fetch key, this->aliases[normalizedName] {
            let normalizedName = this->normalizeName(key);
        }
        return [name, normalizedName];
    }

    /**
     * @param mixed obj
     * @return \Auryn\ReflectorInterface
     */
    protected function shareInstance(var obj) -> <ReflectorInterface>
    {
        var normalizedName;

        let normalizedName = this->normalizeName(get_class(obj));
        if isset this->aliases[normalizedName] {
            // You cannot share an instance of a class name that is already aliased
            throw new InjectorException(
                sprintf(
                    self::errorMessages[self::E_ALIASED_CANNOT_SHARE],
                    normalizedName,
                    this->aliases[normalizedName]
                ),
                self::E_ALIASED_CANNOT_SHARE
            );
        }
        let this->shares[normalizedName] = obj;

        return this;
    }

    /**
     * Register a mutator callable to modify/prepare objects of type $name after instantiation
     *
     * Any callable or provisionable invokable may be specified. Preparers are passed two
     * arguments: the instantiated object to be mutated and the current Injector instance.
     *
     * @param string name
     * @param mixed callableOrMethodStr Any callable or provisionable invokable method
     * @return \Auryn\ReflectorInterface
     */
    public function mutate(string! name, var callableOrMethodStr)
    {
        var value, normalizedName;

        if !this->isInvokable(callableOrMethodStr) {
            throw new InjectorException(
                self::errorMessages[self::E_INVOKABLE],
                self::E_INVOKABLE
            );
        }

        let value = this->resolveAlias(name);
        let normalizedName = end(value);
        let this->mutators[normalizedName] = callableOrMethodStr;

        return this;
    }

    /**
     * @param mixed exe
     * @return boolean
     */
    protected function isInvokable(var exe) -> boolean
    {
        if typeof exe == "object" && is_callable(exe) {
            return true;
        }

        if typeof exe == "string" && method_exists(exe, "__invoke") {
            return true;
        }

        if typeof exe == "array" {
            if isset exe[0] {
                if isset exe[1] {
                    if method_exists(exe[0], exe[1]) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Delegate the creation of $name instances to the specified callable
     *
     * @param string name
     * @param mixed callableOrMethodStr Any callable or provisionable invokable method
     * @return \Auryn\ReflectorInterface
     */
    public function delegate(string! name, var callableOrMethodStr) -> <ReflectorInterface>
    {
        var normalizedName;

        if !this->isInvokable(callableOrMethodStr) {
            throw new InjectorException(
                sprintf(self::errorMessages[self::E_DELEGATE_ARGUMENT], __CLASS__),
                self::E_DELEGATE_ARGUMENT
            );
        }

        let normalizedName = this->normalizeName(name);
        let this->delegates[normalizedName] = callableOrMethodStr;

        return this;
    }

    /**
     * Retrieve stored data for the specified definition type
     *
     * Exposes introspection of existing binds/delegates/shares/etc. for decoration and composition.
     *
     * @param string nameFilter An optional class name filter
     * @param int typeFilter A bitmask of Injector::* type constant flags
     * @return array
     */
    public function inspect(string! nameFilter = null, int typeFilter = null) -> array
    {
        var result, name, elements;

        let result = [];
        if !empty nameFilter {
            let name = this->normalizeName(nameFilter);
        } else {
            let name = null;
        }

        if typeof typeFilter == "null" {
            let typeFilter = self::I_ALL;
        }

        let elements = this->filter(this->bindings, name);
        if (typeFilter & self::I_BINDINGS) && elements {
            let result[self::I_BINDINGS] = elements;
        }

        let elements = this->filter(this->delegates, name);
        if (typeFilter & self::I_DELEGATES) && elements {
            let result[self::I_DELEGATES] = elements;
        }

        let elements = this->filter(this->mutators, name);
        if (typeFilter & self::I_MUTATORS) && elements {
            let result[self::I_MUTATORS] = elements;
        }

        let elements = this->filter(this->aliases, name);
        if (typeFilter & self::I_ALIASES) && elements {
            let result[self::I_ALIASES] = elements;
        }

        let elements = this->filter(this->shares, name);
        if (typeFilter & self::I_SHARES) && elements {
            let result[self::I_SHARES] = elements;
        }

        return result;
    }

    protected function filter(var source, string! name) -> array
    {
        if empty name {
            return source;
        }
        if isset source[name] {
            return source[name];
        }
        return [];
    }

    /**
     * Instantiate/provision a class instance
     *
     * @param string name
     * @param array args
     * @return mixed
     * @TODO fix call to provisionInstance
     */
    public function make(string! name, array args = [])
    {
        var className, normalizedClass, invokable, obj, resolvedAlias;

        let resolvedAlias = this->resolveAlias(name);
        let className = resolvedAlias[0];
        let normalizedClass = resolvedAlias[1];

        if isset this->inProgress[normalizedClass] {
            throw new InjectorException(
                sprintf(
                    self::errorMessages[self::E_CYCLIC_DEPENDENCY],
                    className
                ),
                self::E_CYCLIC_DEPENDENCY
            );
        }

        let this->inProgress[normalizedClass] = true;

        // isset() is used specifically here because classes may be marked as "shared" before an
        // instance is stored. In these cases the class is "shared," but it has a null value and
        // instantiation is needed.
        if isset this->shares[normalizedClass] {
            unset this->inProgress[normalizedClass];

            return this->shares[normalizedClass];
        }

        if isset this->delegates[normalizedClass] {
            let invokable = this->makeInvokable(this->delegates[normalizedClass]);
            let obj = {invokable}(className, this);
        } else {
            let obj = this->{"provisionInstance"}(className, normalizedClass, args);
        }

        if array_key_exists(normalizedClass, this->shares) {
            let this->shares[normalizedClass] = obj;
        }

        this->{"mutateInstance"}(obj, normalizedClass);

        unset this->inProgress[normalizedClass];

        return obj;
    }











    /**
     * Provision an Invokable instance from any valid callable or class/method string
     *
     * @param mixed $callableOrMethodStr A valid PHP callable or a provisionable ClassName::methodName string
     * @return \Auryn\Invokable
     */
    public function makeInvokable($callableOrMethodStr) -> <Invokable>
    {
        var invokables, reflFunc, invocationObj;

        let invokables = this->{"generateInvokables"}(callableOrMethodStr);
        let reflFunc = invokables[0], invocationObj = invokables[1];

        return new Invokable(reflFunc, invocationObj);
    }




    protected function generateStringClassMethodCallable(className, method) -> array
    {
        var relativeStaticMethodStartPos, childReflection, reflectionMethod;

        let relativeStaticMethodStartPos = strpos(method, "parent::");

        if relativeStaticMethodStartPos == 0 {
            let childReflection = this->reflector->getClass(className);
            let className = childReflection->getParentClass()->name;
            let method = substr(method, relativeStaticMethodStartPos + 8);
        }

        let reflectionMethod = this->reflector->getMethod(className, method);

        if reflectionMethod->isStatic() {
            return [reflectionMethod, null];
        }
        return [reflectionMethod, this->make(className)];
    }

    protected function generateInvokablesFromArray(var arrayInvokable) -> array
    {
        var classOrObj, method, callableRefl, invokableArr;

        let classOrObj = arrayInvokable[0], method = arrayInvokable[1];

        if typeof classOrObj == "object" && method_exists(classOrObj, method) {
            let callableRefl = this->reflector->getMethod(classOrObj, method);
            let invokableArr = [callableRefl, classOrObj];
        } else {
            if typeof classOrObj == "string" {
                let invokableArr = this->{"generateStringClassMethodCallable"}(classOrObj, method);
            } else {
                throw new InjectorException(self::errorMessages[self::E_INVOKABLE], self::E_INVOKABLE);
            }
        }

        return invokableArr;
    }
}
