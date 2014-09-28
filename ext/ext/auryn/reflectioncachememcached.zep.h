
extern zend_class_entry *auryn_reflectioncachememcached_ce;

ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheMemcached);

PHP_METHOD(Auryn_ReflectionCacheMemcached, __construct);
PHP_METHOD(Auryn_ReflectionCacheMemcached, setTimeToLive);
PHP_METHOD(Auryn_ReflectionCacheMemcached, fetch);
PHP_METHOD(Auryn_ReflectionCacheMemcached, store);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncachememcached___construct, 0, 0, 1)
	ZEND_ARG_OBJ_INFO(0, memcached, Memcached, 0)
	ZEND_ARG_OBJ_INFO(0, localCache, Auryn\\ReflectionCacheInterface, 1)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncachememcached_settimetolive, 0, 0, 1)
	ZEND_ARG_INFO(0, seconds)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncachememcached_fetch, 0, 0, 1)
	ZEND_ARG_INFO(0, key)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncachememcached_store, 0, 0, 2)
	ZEND_ARG_INFO(0, key)
	ZEND_ARG_INFO(0, data)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_reflectioncachememcached_method_entry) {
	PHP_ME(Auryn_ReflectionCacheMemcached, __construct, arginfo_auryn_reflectioncachememcached___construct, ZEND_ACC_PUBLIC|ZEND_ACC_CTOR)
	PHP_ME(Auryn_ReflectionCacheMemcached, setTimeToLive, arginfo_auryn_reflectioncachememcached_settimetolive, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_ReflectionCacheMemcached, fetch, arginfo_auryn_reflectioncachememcached_fetch, ZEND_ACC_PUBLIC)
	PHP_ME(Auryn_ReflectionCacheMemcached, store, arginfo_auryn_reflectioncachememcached_store, ZEND_ACC_PUBLIC)
  PHP_FE_END
};
