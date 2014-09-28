
extern zend_class_entry *auryn_reflectioncacheapc_ce;

ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheApc);

PHP_METHOD(Auryn_ReflectionCacheApc, __construct);
PHP_METHOD(Auryn_ReflectionCacheApc, setTimeToLive);
PHP_METHOD(Auryn_ReflectionCacheApc, fetch);
PHP_METHOD(Auryn_ReflectionCacheApc, store);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncacheapc___construct, 0, 0, 0)
	ZEND_ARG_OBJ_INFO(0, localCache, Auryn\\ReflectionCacheInterface, 1)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncacheapc_settimetolive, 0, 0, 1)
	ZEND_ARG_INFO(0, seconds)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncacheapc_fetch, 0, 0, 1)
	ZEND_ARG_INFO(0, key)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncacheapc_store, 0, 0, 2)
	ZEND_ARG_INFO(0, key)
	ZEND_ARG_INFO(0, data)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_reflectioncacheapc_method_entry) {
	PHP_ME(Auryn_ReflectionCacheApc, __construct, arginfo_auryn_reflectioncacheapc___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(Auryn_ReflectionCacheApc, setTimeToLive, arginfo_auryn_reflectioncacheapc_settimetolive, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_ReflectionCacheApc, fetch, arginfo_auryn_reflectioncacheapc_fetch, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_ReflectionCacheApc, store, arginfo_auryn_reflectioncacheapc_store, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
