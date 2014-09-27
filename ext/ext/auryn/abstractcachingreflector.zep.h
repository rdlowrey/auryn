
extern zend_class_entry *auryn_abstractcachingreflector_ce;

ZEPHIR_INIT_CLASS(Auryn_AbstractCachingReflector);

PHP_METHOD(Auryn_AbstractCachingReflector, __construct);
PHP_METHOD(Auryn_AbstractCachingReflector, getClass);
PHP_METHOD(Auryn_AbstractCachingReflector, getCtor);
PHP_METHOD(Auryn_AbstractCachingReflector, getCtorParams);
PHP_METHOD(Auryn_AbstractCachingReflector, getParamTypeHint);
PHP_METHOD(Auryn_AbstractCachingReflector, getFunction);
PHP_METHOD(Auryn_AbstractCachingReflector, getMethod);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector___construct, 0, 0, 0)
	ZEND_ARG_OBJ_INFO(0, reflector, Auryn\\ReflectorInterface, 1)
	ZEND_ARG_OBJ_INFO(0, cache, Auryn\\ReflectionCacheInterface, 1)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector_getclass, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector_getctor, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector_getctorparams, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector_getparamtypehint, 0, 0, 2)
	ZEND_ARG_OBJ_INFO(0, function, ReflectionFunctionAbstract, 0)
	ZEND_ARG_OBJ_INFO(0, param, ReflectionParameter, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector_getfunction, 0, 0, 1)
	ZEND_ARG_INFO(0, functionName)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_abstractcachingreflector_getmethod, 0, 0, 2)
	ZEND_ARG_INFO(0, classNameOrInstance)
	ZEND_ARG_INFO(0, methodName)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_abstractcachingreflector_method_entry) {
	PHP_ME(Auryn_AbstractCachingReflector, __construct, arginfo_auryn_abstractcachingreflector___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(Auryn_AbstractCachingReflector, getClass, arginfo_auryn_abstractcachingreflector_getclass, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractCachingReflector, getCtor, arginfo_auryn_abstractcachingreflector_getctor, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractCachingReflector, getCtorParams, arginfo_auryn_abstractcachingreflector_getctorparams, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractCachingReflector, getParamTypeHint, arginfo_auryn_abstractcachingreflector_getparamtypehint, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractCachingReflector, getFunction, arginfo_auryn_abstractcachingreflector_getfunction, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_AbstractCachingReflector, getMethod, arginfo_auryn_abstractcachingreflector_getmethod, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
