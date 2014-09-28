
extern zend_class_entry *auryn_cachingreflector_ce;

ZEPHIR_INIT_CLASS(Auryn_CachingReflector);

PHP_METHOD(Auryn_CachingReflector, __construct);
PHP_METHOD(Auryn_CachingReflector, getClass);
PHP_METHOD(Auryn_CachingReflector, getCtor);
PHP_METHOD(Auryn_CachingReflector, getCtorParams);
PHP_METHOD(Auryn_CachingReflector, getParamTypeHint);
PHP_METHOD(Auryn_CachingReflector, getFunction);
PHP_METHOD(Auryn_CachingReflector, getMethod);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector___construct, 0, 0, 0)
	ZEND_ARG_OBJ_INFO(0, reflector, Auryn\\ReflectorInterface, 1)
	ZEND_ARG_OBJ_INFO(0, cache, Auryn\\ReflectionCacheInterface, 1)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector_getclass, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector_getctor, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector_getctorparams, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector_getparamtypehint, 0, 0, 2)
	ZEND_ARG_OBJ_INFO(0, function, ReflectionFunctionAbstract, 0)
	ZEND_ARG_OBJ_INFO(0, param, ReflectionParameter, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector_getfunction, 0, 0, 1)
	ZEND_ARG_INFO(0, functionName)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_cachingreflector_getmethod, 0, 0, 2)
	ZEND_ARG_INFO(0, classNameOrInstance)
	ZEND_ARG_INFO(0, methodName)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_cachingreflector_method_entry) {
	PHP_ME(Auryn_CachingReflector, __construct, arginfo_auryn_cachingreflector___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(Auryn_CachingReflector, getClass, arginfo_auryn_cachingreflector_getclass, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_CachingReflector, getCtor, arginfo_auryn_cachingreflector_getctor, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_CachingReflector, getCtorParams, arginfo_auryn_cachingreflector_getctorparams, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_CachingReflector, getParamTypeHint, arginfo_auryn_cachingreflector_getparamtypehint, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_CachingReflector, getFunction, arginfo_auryn_cachingreflector_getfunction, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_CachingReflector, getMethod, arginfo_auryn_cachingreflector_getmethod, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
