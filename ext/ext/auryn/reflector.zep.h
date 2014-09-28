
extern zend_class_entry *auryn_reflector_ce;

ZEPHIR_INIT_CLASS(Auryn_Reflector);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflector_getclass, 0, 0, 1)
	ZEND_ARG_INFO(0, class)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflector_getctor, 0, 0, 1)
	ZEND_ARG_INFO(0, class)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflector_getctorparams, 0, 0, 1)
	ZEND_ARG_INFO(0, class)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflector_getparamtypehint, 0, 0, 2)
	ZEND_ARG_OBJ_INFO(0, function, ReflectionFunctionAbstract, 0)
	ZEND_ARG_OBJ_INFO(0, param, ReflectionParameter, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflector_getfunction, 0, 0, 1)
	ZEND_ARG_INFO(0, functionName)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflector_getmethod, 0, 0, 2)
	ZEND_ARG_INFO(0, classNameOrInstance)
	ZEND_ARG_INFO(0, methodName)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_reflector_method_entry) {
	PHP_ABSTRACT_ME(Auryn_Reflector, getClass, arginfo_auryn_reflector_getclass)
	PHP_ABSTRACT_ME(Auryn_Reflector, getCtor, arginfo_auryn_reflector_getctor)
	PHP_ABSTRACT_ME(Auryn_Reflector, getCtorParams, arginfo_auryn_reflector_getctorparams)
	PHP_ABSTRACT_ME(Auryn_Reflector, getParamTypeHint, arginfo_auryn_reflector_getparamtypehint)
	PHP_ABSTRACT_ME(Auryn_Reflector, getFunction, arginfo_auryn_reflector_getfunction)
	PHP_ABSTRACT_ME(Auryn_Reflector, getMethod, arginfo_auryn_reflector_getmethod)
  PHP_FE_END
};
