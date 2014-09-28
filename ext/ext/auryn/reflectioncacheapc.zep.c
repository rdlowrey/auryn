
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


ZEPHIR_INIT_CLASS(Auryn_ReflectionCacheApc) {

	ZEPHIR_REGISTER_CLASS(Auryn, ReflectionCacheApc, auryn, reflectioncacheapc, auryn_reflectioncacheapc_method_entry, 0);

	zend_declare_property_null(auryn_reflectioncacheapc_ce, SL("localCache"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_long(auryn_reflectioncacheapc_ce, SL("timeToLive"), 5, ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_class_implements(auryn_reflectioncacheapc_ce TSRMLS_CC, 1, auryn_reflectioncacheinterface_ce);
	return SUCCESS;

}

PHP_METHOD(Auryn_ReflectionCacheApc, __construct) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_bool _0;
	zval *localCache = NULL, *_1;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 0, 1, &localCache);

	if (!localCache) {
		localCache = ZEPHIR_GLOBAL(global_null);
	}


	_0 = Z_TYPE_P(localCache) != IS_NULL;
	if (_0) {
		_0 = !zephir_instance_of_ev(localCache, auryn_reflectioncacheinterface_ce TSRMLS_CC);
	}
	if (_0) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'localCache' must be an instance of 'Auryn\\\\ReflectionCacheInterface'", "", 0);
		return;
	}
	if (Z_TYPE_P(localCache) != IS_NULL) {
		zephir_update_property_this(this_ptr, SL("localCache"), localCache TSRMLS_CC);
	} else {
		ZEPHIR_INIT_VAR(_1);
		object_init_ex(_1, auryn_reflectioncachearray_ce);
		if (zephir_has_constructor(_1 TSRMLS_CC)) {
			ZEPHIR_CALL_METHOD(NULL, _1, "__construct", NULL);
			zephir_check_call_status();
		}
		zephir_update_property_this(this_ptr, SL("localCache"), _1 TSRMLS_CC);
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(Auryn_ReflectionCacheApc, setTimeToLive) {

	zval *seconds_param = NULL, *_0;
	int seconds;

	zephir_fetch_params(0, 1, 0, &seconds_param);

	seconds = zephir_get_intval(seconds_param);


	if (seconds > 0) {
		ZEPHIR_INIT_ZVAL_NREF(_0);
		ZVAL_LONG(_0, seconds);
		zephir_update_property_this(this_ptr, SL("timeToLive"), _0 TSRMLS_CC);
	}
	RETURN_THISW();

}

PHP_METHOD(Auryn_ReflectionCacheApc, fetch) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *key_param = NULL, *localData = NULL, *_0, *_1 = NULL;
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
	if (zephir_is_true(localData)) {
		RETURN_CCTOR(localData);
	}
	ZEPHIR_CALL_FUNCTION(&_1, "apc_exists", NULL, key);
	zephir_check_call_status();
	if (zephir_is_true(_1)) {
		ZEPHIR_RETURN_CALL_FUNCTION("apc_fetch", NULL, key);
		zephir_check_call_status();
		RETURN_MM();
	}
	RETURN_MM_BOOL(0);

}

PHP_METHOD(Auryn_ReflectionCacheApc, store) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *key_param = NULL, *data, *_0, *_1;
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
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("timeToLive"), PH_NOISY_CC);
	ZEPHIR_CALL_FUNCTION(NULL, "apc_store", NULL, key, data, _1);
	zephir_check_call_status();
	RETURN_THIS();

}

