
extern zend_class_entry *auryn_reflectioncacheinterface_ce;

ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheInterface);

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncacheinterface_fetch, 0, 0, 1)
	ZEND_ARG_INFO(0, key)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_auryn_reflectioncacheinterface_store, 0, 0, 2)
	ZEND_ARG_INFO(0, key)
	ZEND_ARG_INFO(0, data)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(auryn_reflectioncacheinterface_method_entry) {
	PHP_ABSTRACT_ME(Auryn_ReflectionCacheInterface, fetch, arginfo_auryn_reflectioncacheinterface_fetch)
	PHP_ABSTRACT_ME(Auryn_ReflectionCacheInterface, store, arginfo_auryn_reflectioncacheinterface_store)
  PHP_FE_END
};
