
extern zend_class_entry *auryn_abstractinjector_ce;

ZEPHIR_INIT_CLASS(Auryn_AbstractInjector);

PHP_METHOD(Auryn_AbstractInjector, __construct);
PHP_METHOD(Auryn_AbstractInjector, bind);
PHP_METHOD(Auryn_AbstractInjector, bindParam);
PHP_METHOD(Auryn_AbstractInjector, alias);
PHP_METHOD(Auryn_AbstractInjector, normalizeName);
PHP_METHOD(Auryn_AbstractInjector, share);
PHP_METHOD(Auryn_AbstractInjector, shareClass);
PHP_METHOD(Auryn_AbstractInjector, resolveAlias);
PHP_METHOD(Auryn_AbstractInjector, shareInstance);
PHP_METHOD(Auryn_AbstractInjector, mutate);
PHP_METHOD(Auryn_AbstractInjector, isInvokable);
PHP_METHOD(Auryn_AbstractInjector, delegate);
PHP_METHOD(Auryn_AbstractInjector, inspect);
PHP_METHOD(Auryn_AbstractInjector, filter);
PHP_METHOD(Auryn_AbstractInjector, make);
PHP_METHOD(Auryn_AbstractInjector, makeInvokable);
PHP_METHOD(Auryn_AbstractInjector, generateStringClassMethodCallable);
PHP_METHOD(Auryn_AbstractInjector, generateInvokablesFromArray);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector___construct, 0, 0, 0)
	ZEND_ARG_OBJ_INFO(0, reflector, Auryn\\ReflectorInterface, 1)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_bind, 0, 0, 2)
	ZEND_ARG_INFO(0, name)
	ZEND_ARG_ARRAY_INFO(0, args, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_bindparam, 0, 0, 2)
	ZEND_ARG_INFO(0, paramName)
	ZEND_ARG_INFO(0, value)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_alias, 0, 0, 2)
	ZEND_ARG_INFO(0, original)
	ZEND_ARG_INFO(0, alias)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_normalizename, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_share, 0, 0, 1)
	ZEND_ARG_INFO(0, nameOrInstance)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_shareclass, 0, 0, 1)
	ZEND_ARG_INFO(0, nameOrInstance)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_resolvealias, 0, 0, 1)
	ZEND_ARG_INFO(0, name)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_shareinstance, 0, 0, 1)
	ZEND_ARG_INFO(0, obj)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_mutate, 0, 0, 2)
	ZEND_ARG_INFO(0, name)
	ZEND_ARG_INFO(0, callableOrMethodStr)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_isinvokable, 0, 0, 1)
	ZEND_ARG_INFO(0, exe)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_delegate, 0, 0, 2)
	ZEND_ARG_INFO(0, name)
	ZEND_ARG_INFO(0, callableOrMethodStr)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_inspect, 0, 0, 0)
	ZEND_ARG_INFO(0, nameFilter)
	ZEND_ARG_INFO(0, typeFilter)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_filter, 0, 0, 2)
	ZEND_ARG_INFO(0, source)
	ZEND_ARG_INFO(0, name)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_make, 0, 0, 1)
	ZEND_ARG_INFO(0, name)
	ZEND_ARG_ARRAY_INFO(0, args, 1)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_makeinvokable, 0, 0, 1)
	ZEND_ARG_INFO(0, callableOrMethodStr)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_generatestringclassmethodcallable, 0, 0, 2)
	ZEND_ARG_INFO(0, className)
	ZEND_ARG_INFO(0, method)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractinjector_generateinvokablesfromarray, 0, 0, 1)
	ZEND_ARG_INFO(0, arrayInvokable)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_abstractinjector_method_entry) {
	PHP_ME(Auryn_AbstractInjector, __construct, arginfo_auryn_abstractinjector___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(Auryn_AbstractInjector, bind, arginfo_auryn_abstractinjector_bind, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, bindParam, arginfo_auryn_abstractinjector_bindparam, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, alias, arginfo_auryn_abstractinjector_alias, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, normalizeName, arginfo_auryn_abstractinjector_normalizename, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, share, arginfo_auryn_abstractinjector_share, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, shareClass, arginfo_auryn_abstractinjector_shareclass, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, resolveAlias, arginfo_auryn_abstractinjector_resolvealias, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, shareInstance, arginfo_auryn_abstractinjector_shareinstance, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, mutate, arginfo_auryn_abstractinjector_mutate, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, isInvokable, arginfo_auryn_abstractinjector_isinvokable, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, delegate, arginfo_auryn_abstractinjector_delegate, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, inspect, arginfo_auryn_abstractinjector_inspect, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, filter, arginfo_auryn_abstractinjector_filter, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, make, arginfo_auryn_abstractinjector_make, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, makeInvokable, arginfo_auryn_abstractinjector_makeinvokable, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractInjector, generateStringClassMethodCallable, arginfo_auryn_abstractinjector_generatestringclassmethodcallable, ZEND_ACC_PROTECTED)
	PHP_ME(Auryn_AbstractInjector, generateInvokablesFromArray, arginfo_auryn_abstractinjector_generateinvokablesfromarray, ZEND_ACC_PROTECTED)
  PHP_FE_END
};
