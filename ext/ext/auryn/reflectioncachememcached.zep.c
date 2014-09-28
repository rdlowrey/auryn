
#ifdef HAVE_CONFIG_H
#include "../ext_config.h"
#endif

#include <php.h>
#include "../php_ext.h"
#include "../ext.h"

#include <Zend/zend_operators.h>
#include <Zend/zend_exceptions.h>
#include <Zend/zend_interfaces.h>

#include "kernel/main.h"
#include "kernel/object.h"
#include "kernel/exception.h"
#include "kernel/memory.h"
#include "kernel/fcall.h"
#include "kernel/operators.h"
#include "ext/spl/spl_exceptions.h"


ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheMemcached) {

	ZEPHIR_REGISTER_CLASS(Auryn, ReflectionCacheMemcached, auryn, reflectioncachememcached, auryn_reflectioncachememcached_method_entry, 0);

	zend_declare_property_null(auryn_reflectioncachememcached_ce, SL("localCache"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_long(auryn_reflectioncachememcached_ce, SL("timeToLive"), 5, ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_null(auryn_reflectioncachememcached_ce, SL("memcached"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_class_implements(auryn_reflectioncachememcached_ce TSRMLS_CC, 1, auryn_reflectioncacheinterface_ce);
	return SUCCESS;

}

PHP_METHOD(Auryn_ReflectionCacheMemcached, __construct) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_bool _0;
	zval *memcached, *localCache = NULL, *_1;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 1, &memcached, &localCache);

	if (!localCache) {
		localCache = ZEPHIR_GLOBAL(global_null);
	}


	if (!(zephir_is_instance_of(memcached, SL("Memcached") TSRMLS_CC))) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'memcached' must be an instance of 'Memcached'", "", 0);
		return;
	}
	_0 = Z_TYPE_P(localCache) != IS_NULL;
	if (_0) {
		_0 = !zephir_instance_of_ev(localCache, auryn_reflectioncacheinterface_ce TSRMLS_CC);
	}
	if (_0) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'localCache' must be an instance of 'Auryn\\\\ReflectionCacheInterface'", "", 0);
		return;
	}
	zephir_update_property_this(this_ptr, SL("memcached"), memcached TSRMLS_CC);
	if (Z_TYPE_P(localCache) != IS_NULL) {
		zephir_update_property_this(this_ptr, SL("localCache"), localCache TSRMLS_CC);
	} else {
		ZEPHIR_INIT_VAR(_1);
		object_init_ex(_1, auryn_reflectioncachearray_ce);
		ZEPHIR_CALL_METHOD(NULL, _1, "__construct", NULL);
		zephir_check_call_status();
		zephir_update_property_this(this_ptr, SL("localCache"), _1 TSRMLS_CC);
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(Auryn_ReflectionCacheMemcached, setTimeToLive) {

	zval *seconds_param = NULL, *_0 = NULL;
	int seconds;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &seconds_param);

	seconds = zephir_get_intval(seconds_param);


	ZEPHIR_INIT_VAR(_0);
	if (seconds > 0) {
		ZEPHIR_INIT_BNVAR(_0);
		ZVAL_LONG(_0, seconds);
	} else {
		ZEPHIR_OBS_NVAR(_0);
		zephir_read_property_this(&_0, this_ptr, SL("timeToLive"), PH_NOISY_CC);
	}
	zephir_update_property_this(this_ptr, SL("timeToLive"), _0 TSRMLS_CC);
	RETURN_THIS();

}

PHP_METHOD(Auryn_ReflectionCacheMemcached, fetch) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *key_param = NULL, *localData = NULL, *_0, *_1;
	zval *key = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &key_param);

	if (unlikely(Z_TYPE_P(key_param) != IS_STRING && Z_TYPE_P(key_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'key' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(key_param) == IS_STRING)) {
		key = key_param;
	} else {
		ZEPHIR_INIT_VAR(key);
		ZVAL_EMPTY_STRING(key);
	}


	_0 = zephir_fetch_nproperty_this(this_ptr, SL("localCache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&localData, _0, "fetch", NULL, key);
	zephir_check_call_status();
	if (!ZEPHIR_IS_FALSE(localData)) {
		RETURN_CCTOR(localData);
	}
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("memcached"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&localData, _1, "get", NULL, key);
	zephir_check_call_status();
	if (!ZEPHIR_IS_FALSE(localData)) {
		RETURN_CCTOR(localData);
	}
	RETURN_MM_BOOL(0);

}

PHP_METHOD(Auryn_ReflectionCacheMemcached, store) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *key_param = NULL, *data, *_0, *_1, *_2;
	zval *key = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &key_param, &data);

	if (unlikely(Z_TYPE_P(key_param) != IS_STRING && Z_TYPE_P(key_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'key' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(key_param) == IS_STRING)) {
		key = key_param;
	} else {
		ZEPHIR_INIT_VAR(key);
		ZVAL_EMPTY_STRING(key);
	}


	_0 = zephir_fetch_nproperty_this(this_ptr, SL("localCache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(NULL, _0, "store", NULL, key, data);
	zephir_check_call_status();
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("memcached"), PH_NOISY_CC);
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("timeToLive"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(NULL, _1, "set", NULL, key, data, _2);
	zephir_check_call_status();
	RETURN_THIS();

}

