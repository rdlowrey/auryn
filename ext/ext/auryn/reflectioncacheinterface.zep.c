
#ifdef HAVE_CONFIG_H
#include "../ext_config.h"
#endif

#include <php.h>
#include "../php_ext.h"
#include "../ext.h"

#include <Zend/zend_exceptions.h>

#include "kernel/main.h"


ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheInterface) {

	ZEPHIR_REGISTER_INTERFACE(Auryn, ReflectionCacheInterface, auryn, reflectioncacheinterface, auryn_reflectioncacheinterface_method_entry);

	return SUCCESS;

}

/**
 * @param string key
 */
ZEPHIR_DOC_METHOD(Auryn_ReflectionCacheInterface, fetch);

/**
 * @param string key
 * @param array data
 */
ZEPHIR_DOC_METHOD(Auryn_ReflectionCacheInterface, store);

