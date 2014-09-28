
extern zend_class_entry *auryn_reflectorinterface_ce;

ZEPHIR_INIT_CLASS(Auryn_ReflectorInterface);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectorinterface_getclass, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectorinterface_getctor, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectorinterface_getctorparams, 0, 0, 1)
	ZEND_ARG_INFO(0, className)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectorinterface_getparamtypehint, 0, 0, 2)
	ZEND_ARG_OBJ_INFO(0, function, ReflectionFunctionAbstract, 0)
	ZEND_ARG_OBJ_INFO(0, param, ReflectionParameter, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectorinterface_getfunction, 0, 0, 1)
	ZEND_ARG_INFO(0, functionName)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectorinterface_getmethod, 0, 0, 2)
	ZEND_ARG_INFO(0, classNameOrInstance)
	ZEND_ARG_INFO(0, methodName)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_reflectorinterface_method_entry) {
	PHP_ABSTRACT_ME(Auryn_ReflectorInterface, getClass, arginfo_auryn_reflectorinterface_getclass)
	PHP_ABSTRACT_ME(Auryn_ReflectorInterface, getCtor, arginfo_auryn_reflectorinterface_getctor)
	PHP_ABSTRACT_ME(Auryn_ReflectorInterface, getCtorParams, arginfo_auryn_reflectorinterface_getctorparams)
	PHP_ABSTRACT_ME(Auryn_ReflectorInterface, getParamTypeHint, arginfo_auryn_reflectorinterface_getparamtypehint)
	PHP_ABSTRACT_ME(Auryn_ReflectorInterface, getFunction, arginfo_auryn_reflectorinterface_getfunction)
	PHP_ABSTRACT_ME(Auryn_ReflectorInterface, getMethod, arginfo_auryn_reflectorinterface_getmethod)
  PHP_FE_END
};
