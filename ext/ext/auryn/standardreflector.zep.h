
extern zend_class_entry *auryn_standardreflector_ce;

ZEPHIR_INIT_CLASS(Auryn_StandardReflector);

PHP_METHOD(Auryn_StandardReflector, getClass);
PHP_METHOD(Auryn_StandardReflector, getCtor);
PHP_METHOD(Auryn_StandardReflector, getCtorParams);
PHP_METHOD(Auryn_StandardReflector, getParamTypeHint);
PHP_METHOD(Auryn_StandardReflector, getFunction);
PHP_METHOD(Auryn_StandardReflector, getMethod);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_standardreflector_getclass, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_standardreflector_getctor, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_standardreflector_getctorparams, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_standardreflector_getparamtypehint, 0, 0, 2)
	ZEND_ARG_OBJ_INFO(0, function, ReflectionFunctionAbstract, 0)
	ZEND_ARG_OBJ_INFO(0, param, ReflectionParameter, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_standardreflector_getfunction, 0, 0, 1)
	ZEND_ARG_INFO(0, functionName)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_standardreflector_getmethod, 0, 0, 2)
	ZEND_ARG_INFO(0, classNameOrInstance)
	ZEND_ARG_INFO(0, methodName)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_standardreflector_method_entry) {
	PHP_ME(Auryn_StandardReflector, getClass, arginfo_auryn_standardreflector_getclass, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_StandardReflector, getCtor, arginfo_auryn_standardreflector_getctor, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_StandardReflector, getCtorParams, arginfo_auryn_standardreflector_getctorparams, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_StandardReflector, getParamTypeHint, arginfo_auryn_standardreflector_getparamtypehint, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_StandardReflector, getFunction, arginfo_auryn_standardreflector_getfunction, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_StandardReflector, getMethod, arginfo_auryn_standardreflector_getmethod, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
