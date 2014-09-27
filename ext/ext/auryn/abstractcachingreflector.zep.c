
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
#include "kernel/concat.h"
#include "kernel/string.h"
#include "kernel/operators.h"
#include "ext/spl/spl_exceptions.h"


ZEPHIR_INIT_CLASS(Auryn_AbstractCachingReflector) {

	ZEPHIR_REGISTER_CLASS(Auryn, AbstractCachingReflector, auryn, abstractcachingreflector, auryn_abstractcachingreflector_method_entry, ZEND_ACC_EXPLICIT_ABSTRACT_CLASS);

	zend_declare_property_null(auryn_abstractcachingreflector_ce, SL("reflector"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractcachingreflector_ce, SL("cache"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractcachingreflector_ce, SL("CACHE_KEY_CLASSES"), "auryn.refls.classes." TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractcachingreflector_ce, SL("CACHE_KEY_CTORS"), "auryn.refls.ctors." TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractcachingreflector_ce, SL("CACHE_KEY_CTOR_PARAMS"), "auryn.refls.ctor-params." TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractcachingreflector_ce, SL("CACHE_KEY_FUNCS"), "auryn.refls.funcs." TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractcachingreflector_ce, SL("CACHE_KEY_METHODS"), "auryn.refls.methods." TSRMLS_CC);

	zend_class_implements(auryn_abstractcachingreflector_ce TSRMLS_CC, 1, auryn_reflectorinterface_ce);
	return SUCCESS;

}

PHP_METHOD(Auryn_AbstractCachingReflector, __construct) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_bool _0, _1;
	zval *reflector = NULL, *cache = NULL, *_2 = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 0, 2, &reflector, &cache);

	if (!reflector) {
		reflector = ZEPHIR_GLOBAL(global_null);
	}
	if (!cache) {
		cache = ZEPHIR_GLOBAL(global_null);
	}


	_0 = Z_TYPE_P(reflector) != IS_NULL;
	if (_0) {
		_0 = !zephir_instance_of_ev(reflector, auryn_reflectorinterface_ce TSRMLS_CC);
	}
	if (_0) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'reflector' must be an instance of 'Auryn\\\\ReflectorInterface'", "", 0);
		return;
	}
	_1 = Z_TYPE_P(cache) != IS_NULL;
	if (_1) {
		_1 = !zephir_instance_of_ev(cache, auryn_reflectioncacheinterface_ce TSRMLS_CC);
	}
	if (_1) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'cache' must be an instance of 'Auryn\\\\ReflectionCacheInterface'", "", 0);
		return;
	}
	if (unlikely(Z_TYPE_P(reflector) == IS_NULL)) {
		ZEPHIR_INIT_VAR(_2);
		object_init_ex(_2, auryn_standardreflector_ce);
		if (zephir_has_constructor(_2 TSRMLS_CC)) {
			ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL);
			zephir_check_call_status();
		}
		zephir_update_property_this(this_ptr, SL("reflector"), _2 TSRMLS_CC);
	} else {
		zephir_update_property_this(this_ptr, SL("reflector"), reflector TSRMLS_CC);
	}
	if (unlikely(Z_TYPE_P(cache) == IS_NULL)) {
		ZEPHIR_INIT_LNVAR(_2);
		object_init_ex(_2, auryn_reflectioncachearray_ce);
		if (zephir_has_constructor(_2 TSRMLS_CC)) {
			ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL);
			zephir_check_call_status();
		}
		zephir_update_property_this(this_ptr, SL("cache"), _2 TSRMLS_CC);
	} else {
		zephir_update_property_this(this_ptr, SL("cache"), cache TSRMLS_CC);
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(Auryn_AbstractCachingReflector, getClass) {

	zend_class_entry *_2;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *className_param = NULL, *cacheKey, *reflectionClass = NULL, *_0, *_1, *_3;
	zval *className = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &className_param);

	if (unlikely(Z_TYPE_P(className_param) != IS_STRING && Z_TYPE_P(className_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'className' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(className_param) == IS_STRING)) {
		className = className_param;
	} else {
		ZEPHIR_INIT_VAR(className);
		ZVAL_EMPTY_STRING(className);
	}


	ZEPHIR_INIT_VAR(_0);
	zephir_fast_strtolower(_0, className);
	ZEPHIR_INIT_VAR(cacheKey);
	ZEPHIR_CONCAT_SV(cacheKey, "auryn.refls.classes.", _0);
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&reflectionClass, _1, "fetch", NULL, cacheKey);
	zephir_check_call_status();
	if (!(zephir_is_true(reflectionClass))) {
		ZEPHIR_INIT_BNVAR(reflectionClass);
		_2 = zend_fetch_class(SL("ReflectionClass"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
		object_init_ex(reflectionClass, _2);
		ZEPHIR_CALL_METHOD(NULL, reflectionClass, "__construct", NULL, className);
		zephir_check_call_status();
		_3 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(NULL, _3, "store", NULL, cacheKey, reflectionClass);
		zephir_check_call_status();
	}
	RETURN_CCTOR(reflectionClass);

}

PHP_METHOD(Auryn_AbstractCachingReflector, getCtor) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *className_param = NULL, *cacheKey, *reflectedCtor = NULL, *reflectionClass = NULL, *_0, *_1, *_2;
	zval *className = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &className_param);

	if (unlikely(Z_TYPE_P(className_param) != IS_STRING && Z_TYPE_P(className_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'className' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(className_param) == IS_STRING)) {
		className = className_param;
	} else {
		ZEPHIR_INIT_VAR(className);
		ZVAL_EMPTY_STRING(className);
	}


	ZEPHIR_INIT_VAR(_0);
	zephir_fast_strtolower(_0, className);
	ZEPHIR_INIT_VAR(cacheKey);
	ZEPHIR_CONCAT_SV(cacheKey, "auryn.refls.ctors.", _0);
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&reflectedCtor, _1, "fetch", NULL, cacheKey);
	zephir_check_call_status();
	if (!(zephir_is_true(reflectedCtor))) {
		ZEPHIR_CALL_METHOD(&reflectionClass, this_ptr, "getclass", NULL, className);
		zephir_check_call_status();
		ZEPHIR_CALL_METHOD(&reflectedCtor, reflectionClass, "getconstructor",  NULL);
		zephir_check_call_status();
		_2 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(NULL, _2, "store", NULL, cacheKey, reflectedCtor);
		zephir_check_call_status();
	}
	RETURN_CCTOR(reflectedCtor);

}

PHP_METHOD(Auryn_AbstractCachingReflector, getCtorParams) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *className_param = NULL, *cacheKey, *reflectedCtorParams = NULL, *reflectedCtor = NULL, *_0, *_1, *_2;
	zval *className = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &className_param);

	if (unlikely(Z_TYPE_P(className_param) != IS_STRING && Z_TYPE_P(className_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'className' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(className_param) == IS_STRING)) {
		className = className_param;
	} else {
		ZEPHIR_INIT_VAR(className);
		ZVAL_EMPTY_STRING(className);
	}


	ZEPHIR_INIT_VAR(_0);
	zephir_fast_strtolower(_0, className);
	ZEPHIR_INIT_VAR(cacheKey);
	ZEPHIR_CONCAT_SV(cacheKey, "auryn.refls.ctor-params.", _0);
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&reflectedCtorParams, _1, "fetch", NULL, cacheKey);
	zephir_check_call_status();
	if (zephir_is_true(reflectedCtorParams)) {
		RETURN_CCTOR(reflectedCtorParams);
	} else {
		ZEPHIR_CALL_METHOD(&reflectedCtor, this_ptr, "getctor", NULL, className);
		zephir_check_call_status();
		if (zephir_is_true(reflectedCtor)) {
			ZEPHIR_CALL_METHOD(&reflectedCtorParams, reflectedCtor, "getparameters",  NULL);
			zephir_check_call_status();
		} else {
			ZEPHIR_INIT_BNVAR(reflectedCtorParams);
			ZVAL_NULL(reflectedCtorParams);
		}
	}
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(NULL, _2, "store", NULL, cacheKey, reflectedCtorParams);
	zephir_check_call_status();
	RETURN_CCTOR(reflectedCtorParams);

}

PHP_METHOD(Auryn_AbstractCachingReflector, getParamTypeHint) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *function, *param, *lowParam, *lowClass, *lowMethod, *lowFunc, *paramCacheKey = NULL, *classCacheKey, *typeHint = NULL, *reflectionClass = NULL, *_0, *_1 = NULL, *_2, *_3, *_4;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &function, &param);



	if (!(zephir_is_instance_of(function, SL("ReflectionFunctionAbstract") TSRMLS_CC))) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'function' must be an instance of 'ReflectionFunctionAbstract'", "", 0);
		return;
	}
	if (!(zephir_is_instance_of(param, SL("ReflectionParameter") TSRMLS_CC))) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'param' must be an instance of 'ReflectionParameter'", "", 0);
		return;
	}
	ZEPHIR_INIT_VAR(lowParam);
	ZEPHIR_OBS_VAR(_0);
	zephir_read_property(&_0, param, SL("name"), PH_NOISY_CC);
	zephir_fast_strtolower(lowParam, _0);
	if (zephir_is_instance_of(function, SL("ReflectionMethod") TSRMLS_CC)) {
		ZEPHIR_INIT_VAR(lowClass);
		ZEPHIR_OBS_VAR(_1);
		zephir_read_property(&_1, function, SL("class"), PH_NOISY_CC);
		zephir_fast_strtolower(lowClass, _1);
		ZEPHIR_INIT_VAR(lowMethod);
		ZEPHIR_OBS_VAR(_2);
		zephir_read_property(&_2, function, SL("name"), PH_NOISY_CC);
		zephir_fast_strtolower(lowMethod, _2);
		ZEPHIR_INIT_VAR(paramCacheKey);
		ZEPHIR_CONCAT_SVSVSVSV(paramCacheKey, "auryn.refls.classes.", lowClass, ".", lowMethod, ".", param, "-", lowParam);
	} else {
		ZEPHIR_INIT_VAR(lowFunc);
		ZEPHIR_OBS_NVAR(_1);
		zephir_read_property(&_1, function, SL("name"), PH_NOISY_CC);
		zephir_fast_strtolower(lowFunc, _1);
		ZEPHIR_INIT_NVAR(paramCacheKey);
		if (!ZEPHIR_IS_STRING(lowFunc, "{closure}")) {
			ZEPHIR_CONCAT_SSVSVSV(paramCacheKey, "auryn.refls.funcs.", ".", lowFunc, ".", param, "-", lowParam);
		} else {
			ZVAL_NULL(paramCacheKey);
		}
	}
	if (Z_TYPE_P(paramCacheKey) == IS_NULL) {
		ZEPHIR_INIT_VAR(typeHint);
		ZVAL_BOOL(typeHint, 0);
	} else {
		_3 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(&typeHint, _3, "fetch", NULL, paramCacheKey);
		zephir_check_call_status();
	}
	if (!ZEPHIR_IS_FALSE(typeHint)) {
		RETURN_CCTOR(typeHint);
	}
	ZEPHIR_CALL_METHOD(&reflectionClass, param, "getclass",  NULL);
	zephir_check_call_status();
	if (zephir_is_true(reflectionClass)) {
		ZEPHIR_CALL_METHOD(&typeHint, reflectionClass, "getname",  NULL);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(_4);
		zephir_fast_strtolower(_4, typeHint);
		ZEPHIR_INIT_VAR(classCacheKey);
		ZEPHIR_CONCAT_SV(classCacheKey, "auryn.refls.classes.", _4);
		_3 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(NULL, _3, "store", NULL, classCacheKey, reflectionClass);
		zephir_check_call_status();
	} else {
		ZEPHIR_INIT_NVAR(typeHint);
		ZVAL_NULL(typeHint);
	}
	_3 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(NULL, _3, "store", NULL, paramCacheKey, typeHint);
	zephir_check_call_status();
	RETURN_CCTOR(typeHint);

}

PHP_METHOD(Auryn_AbstractCachingReflector, getFunction) {

	zend_class_entry *_1;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *functionName_param = NULL, *lowFunc, *cacheKey, *reflectedFunc = NULL, *_0, *_2;
	zval *functionName = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &functionName_param);

	if (unlikely(Z_TYPE_P(functionName_param) != IS_STRING && Z_TYPE_P(functionName_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'functionName' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(functionName_param) == IS_STRING)) {
		functionName = functionName_param;
	} else {
		ZEPHIR_INIT_VAR(functionName);
		ZVAL_EMPTY_STRING(functionName);
	}


	ZEPHIR_INIT_VAR(lowFunc);
	zephir_fast_strtolower(lowFunc, functionName);
	ZEPHIR_INIT_VAR(cacheKey);
	ZEPHIR_CONCAT_SV(cacheKey, "auryn.refls.funcs.", lowFunc);
	_0 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&reflectedFunc, _0, "fetch", NULL, cacheKey);
	zephir_check_call_status();
	if (!(zephir_is_true(reflectedFunc))) {
		ZEPHIR_INIT_BNVAR(reflectedFunc);
		_1 = zend_fetch_class(SL("ReflectionFunction"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
		object_init_ex(reflectedFunc, _1);
		ZEPHIR_CALL_METHOD(NULL, reflectedFunc, "__construct", NULL, functionName);
		zephir_check_call_status();
		_2 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(NULL, _2, "store", NULL, cacheKey, reflectedFunc);
		zephir_check_call_status();
	}
	RETURN_CCTOR(reflectedFunc);

}

PHP_METHOD(Auryn_AbstractCachingReflector, getMethod) {

	zend_class_entry *_3;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *methodName = NULL;
	zval *classNameOrInstance, *methodName_param = NULL, *className = NULL, *cacheKey, *reflectedMethod = NULL, *_0, *_1, *_2, *_4;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &classNameOrInstance, &methodName_param);

	if (unlikely(Z_TYPE_P(methodName_param) != IS_STRING && Z_TYPE_P(methodName_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'methodName' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(methodName_param) == IS_STRING)) {
		methodName = methodName_param;
	} else {
		ZEPHIR_INIT_VAR(methodName);
		ZVAL_EMPTY_STRING(methodName);
	}


	if (Z_TYPE_P(classNameOrInstance) == IS_STRING) {
		ZEPHIR_CPY_WRT(className, classNameOrInstance);
	} else {
		ZEPHIR_INIT_VAR(className);
		zephir_get_class(className, classNameOrInstance, 0 TSRMLS_CC);
	}
	ZEPHIR_INIT_VAR(_0);
	zephir_fast_strtolower(_0, className);
	ZEPHIR_INIT_VAR(_1);
	zephir_fast_strtolower(_1, methodName);
	ZEPHIR_INIT_VAR(cacheKey);
	ZEPHIR_CONCAT_SVSV(cacheKey, "auryn.refls.methods.", _0, ".", _1);
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&reflectedMethod, _2, "fetch", NULL, cacheKey);
	zephir_check_call_status();
	if (!(zephir_is_true(reflectedMethod))) {
		ZEPHIR_INIT_BNVAR(reflectedMethod);
		_3 = zend_fetch_class(SL("ReflectionMethod"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
		object_init_ex(reflectedMethod, _3);
		ZEPHIR_CALL_METHOD(NULL, reflectedMethod, "__construct", NULL, className, methodName);
		zephir_check_call_status();
		_4 = zephir_fetch_nproperty_this(this_ptr, SL("cache"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(NULL, _4, "store", NULL, cacheKey, reflectedMethod);
		zephir_check_call_status();
	}
	RETURN_CCTOR(reflectedMethod);

}

