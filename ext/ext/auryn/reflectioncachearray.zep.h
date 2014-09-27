
extern zend_class_entry *auryn_reflectioncachearray_ce;

ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheArray);

PHP_METHOD(Auryn_ReflectionCacheArray, fetch);
PHP_METHOD(Auryn_ReflectionCacheArray, store);
PHP_METHOD(Auryn_ReflectionCacheArray, __construct);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncachearray_fetch, 0, 0, 1)
	ZEND_ARG_INFO(0, key)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncachearray_store, 0, 0, 2)
	ZEND_ARG_INFO(0, key)
	ZEND_ARG_INFO(0, data)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_reflectioncachearray_method_entry) {
	PHP_ME(Auryn_ReflectionCacheArray, fetch, arginfo_auryn_reflectioncachearray_fetch, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_ReflectionCacheArray, store, arginfo_auryn_reflectioncachearray_store, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_ReflectionCacheArray, __construct, NULL, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
  PHP_FE_END
};
