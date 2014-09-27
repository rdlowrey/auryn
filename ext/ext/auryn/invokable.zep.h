
extern zend_class_entry *auryn_invokable_ce;

ZEPHIR_INIT_CLASS(Auryn_Invokable);

PHP_METHOD(Auryn_Invokable, __construct);
PHP_METHOD(Auryn_Invokable, setMethodCallable);
PHP_METHOD(Auryn_Invokable, __invoke);
PHP_METHOD(Auryn_Invokable, getCallableReflection);
PHP_METHOD(Auryn_Invokable, getInvocationObject);
PHP_METHOD(Auryn_Invokable, isInstanceMethod);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_invokable___construct, 0, 0, 1)
	ZEND_ARG_OBJ_INFO(0, reflFunc, ReflectionFunctionAbstract, 0)
	ZEND_ARG_INFO(0, invokeObj)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_invokable_setmethodcallable, 0, 0, 2)
	ZEND_ARG_OBJ_INFO(0, reflection, ReflectionMethod, 0)
	ZEND_ARG_INFO(0, invokeObj)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_invokable_method_entry) {
	PHP_ME(Auryn_Invokable, __construct, arginfo_auryn_invokable___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(Auryn_Invokable, setMethodCallable, arginfo_auryn_invokable_setmethodcallable, ZEND_ACC_PRIVATE)
	PHP_ME(Auryn_Invokable, __invoke, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_Invokable, getCallableReflection, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_Invokable, getInvocationObject, NULL, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_Invokable, isInstanceMethod, NULL, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
