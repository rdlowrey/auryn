
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
#include "kernel/fcall.h"
#include "ext/spl/spl_exceptions.h"
#include "kernel/exception.h"
#include "kernel/memory.h"
#include "kernel/operators.h"
#include "kernel/object.h"


ZEPHIR_INIT_CLASS(Auryn_StandardReflector) {

	ZEPHIR_REGISTER_CLASS(Auryn, StandardReflector, auryn, standardreflector, auryn_standardreflector_method_entry, 0);

	zend_class_implements(auryn_standardreflector_ce TSRMLS_CC, 1, auryn_reflectorinterface_ce);
	return SUCCESS;

}

/**
 * {@inheritDoc}
 */
PHP_METHOD(Auryn_StandardReflector, getClass) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_class_entry *_0;
	zval *className_param = NULL;
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


	_0 = zend_fetch_class(SL("ReflectionClass"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
	object_init_ex(return_value, _0);
	ZEPHIR_CALL_METHOD(NULL, return_value, "__construct", NULL, className);
	zephir_check_call_status();
	RETURN_MM();

}

/**
 * {@inheritDoc}
 */
PHP_METHOD(Auryn_StandardReflector, getCtor) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_class_entry *_0;
	zval *className_param = NULL, *reflectionClass;
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


	ZEPHIR_INIT_VAR(reflectionClass);
	_0 = zend_fetch_class(SL("ReflectionClass"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
	object_init_ex(reflectionClass, _0);
	ZEPHIR_CALL_METHOD(NULL, reflectionClass, "__construct", NULL, className);
	zephir_check_call_status();
	ZEPHIR_RETURN_CALL_METHOD(reflectionClass, "getctor", NULL);
	zephir_check_call_status();
	RETURN_MM();

}

/**
 * {@inheritDoc}
 */
PHP_METHOD(Auryn_StandardReflector, getCtorParams) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *className_param = NULL, *reflectedCtor = NULL;
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


	ZEPHIR_CALL_METHOD(&reflectedCtor, this_ptr, "getctor", NULL, className);
	zephir_check_call_status();
	if (zephir_is_true(reflectedCtor)) {
		ZEPHIR_RETURN_CALL_METHOD(reflectedCtor, "getparameters", NULL);
		zephir_check_call_status();
		RETURN_MM();
	}
	ZEPHIR_THROW_EXCEPTION_DEBUG_STR(auryn_exception_ce, "Could not load reflectedCtor", "auryn/standardreflector.zep", 34);
	return;

}

/**
 * {@inheritDoc}
 */
PHP_METHOD(Auryn_StandardReflector, getParamTypeHint) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *function, *param, *reflectionClass = NULL;

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
	ZEPHIR_CALL_METHOD(&reflectionClass, param, "getclass",  NULL);
	zephir_check_call_status();
	if (zephir_is_true(reflectionClass)) {
		ZEPHIR_RETURN_CALL_METHOD(reflectionClass, "getname", NULL);
		zephir_check_call_status();
		RETURN_MM();
	}
	ZEPHIR_THROW_EXCEPTION_DEBUG_STR(auryn_exception_ce, "Could not load reflection class", "auryn/standardreflector.zep", 47);
	return;

}

/**
 * {@inheritDoc}
 */
PHP_METHOD(Auryn_StandardReflector, getFunction) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_class_entry *_0;
	zval *functionName_param = NULL;
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


	_0 = zend_fetch_class(SL("ReflectionFunction"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
	object_init_ex(return_value, _0);
	ZEPHIR_CALL_METHOD(NULL, return_value, "__construct", NULL, functionName);
	zephir_check_call_status();
	RETURN_MM();

}

/**
 * {@inheritDoc}
 */
PHP_METHOD(Auryn_StandardReflector, getMethod) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_class_entry *_0, *_1;
	zval *methodName = NULL;
	zval *classNameOrInstance, *methodName_param = NULL, *_2;

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
		_0 = zend_fetch_class(SL("ReflectionMethod"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
		object_init_ex(return_value, _0);
		ZEPHIR_CALL_METHOD(NULL, return_value, "__construct", NULL, classNameOrInstance, methodName);
		zephir_check_call_status();
		RETURN_MM();
	}
	_1 = zend_fetch_class(SL("ReflectionMethod"), ZEND_FETCH_CLASS_AUTO TSRMLS_CC);
	object_init_ex(return_value, _1);
	ZEPHIR_INIT_VAR(_2);
	zephir_get_class(_2, classNameOrInstance, 0 TSRMLS_CC);
	ZEPHIR_CALL_METHOD(NULL, return_value, "__construct", NULL, _2, methodName);
	zephir_check_call_status();
	RETURN_MM();

}

