
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
#include "kernel/fcall.h"
#include "kernel/memory.h"
#include "kernel/operators.h"


ZEPHIR_INIT_CLASS(Auryn_Invokable) {

	ZEPHIR_REGISTER_CLASS(Auryn, Invokable, auryn, invokable, auryn_invokable_method_entry, 0);

	zend_declare_property_null(auryn_invokable_ce, SL("reflFunc"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_null(auryn_invokable_ce, SL("invokeObj"), ZEND_ACC_PRIVATE TSRMLS_CC);

	zend_declare_property_null(auryn_invokable_ce, SL("isInstanceMethod"), ZEND_ACC_PRIVATE TSRMLS_CC);

	return SUCCESS;

}

PHP_METHOD(Auryn_Invokable, __construct) {

	zephir_nts_static zephir_fcall_cache_entry *_0 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *reflFunc, *invokeObj = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 1, &reflFunc, &invokeObj);

	if (!invokeObj) {
		invokeObj = ZEPHIR_GLOBAL(global_null);
	}


	if (!(zephir_is_instance_of(reflFunc, SL("ReflectionFunctionAbstract") TSRMLS_CC))) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'reflFunc' must be an instance of 'ReflectionFunctionAbstract'", "", 0);
		return;
	}
	if (zephir_is_instance_of(reflFunc, SL("ReflectionMethod") TSRMLS_CC)) {
		zephir_update_property_this(this_ptr, SL("isInstanceMethod"), (1) ? ZEPHIR_GLOBAL(global_true) : ZEPHIR_GLOBAL(global_false) TSRMLS_CC);
		ZEPHIR_CALL_METHOD(NULL, this_ptr, "setmethodcallable", &_0, reflFunc, invokeObj);
		zephir_check_call_status();
	} else {
		zephir_update_property_this(this_ptr, SL("isInstanceMethod"), (0) ? ZEPHIR_GLOBAL(global_true) : ZEPHIR_GLOBAL(global_false) TSRMLS_CC);
		zephir_update_property_this(this_ptr, SL("reflFunc"), reflFunc TSRMLS_CC);
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(Auryn_Invokable, setMethodCallable) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *reflection, *invokeObj, *_0 = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &reflection, &invokeObj);



	if (!(zephir_is_instance_of(reflection, SL("ReflectionMethod") TSRMLS_CC))) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'reflection' must be an instance of 'ReflectionMethod'", "", 0);
		return;
	}
	if (Z_TYPE_P(invokeObj) == IS_OBJECT) {
		zephir_update_property_this(this_ptr, SL("reflFunc"), reflection TSRMLS_CC);
		zephir_update_property_this(this_ptr, SL("invokeObj"), invokeObj TSRMLS_CC);
	} else {
		ZEPHIR_CALL_METHOD(&_0, reflection, "isstatic",  NULL);
		zephir_check_call_status();
		if (zephir_is_true(_0)) {
			zephir_update_property_this(this_ptr, SL("reflFunc"), reflection TSRMLS_CC);
		} else {
			ZEPHIR_THROW_EXCEPTION_DEBUG_STR(zend_exception_get_default(TSRMLS_C), "ReflectionMethod callables must specify an invocation object", "auryn/invokable.zep", 30);
			return;
		}
	}
	ZEPHIR_MM_RESTORE();

}

PHP_METHOD(Auryn_Invokable, __invoke) {

	int ZEPHIR_LAST_CALL_STATUS;
	zephir_nts_static zephir_fcall_cache_entry *_0 = NULL;
	zval *args = NULL, *_1, *_2, *_3;

	ZEPHIR_MM_GROW();

	ZEPHIR_CALL_FUNCTION(&args, "func_get_args", &_0);
	zephir_check_call_status();
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("isInstanceMethod"), PH_NOISY_CC);
	if (zephir_is_true(_1)) {
		_2 = zephir_fetch_nproperty_this(this_ptr, SL("reflFunc"), PH_NOISY_CC);
		_3 = zephir_fetch_nproperty_this(this_ptr, SL("invokeObj"), PH_NOISY_CC);
		ZEPHIR_RETURN_CALL_METHOD(_2, "invokeargs", NULL, _3, args);
		zephir_check_call_status();
		RETURN_MM();
	}
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("reflFunc"), PH_NOISY_CC);
	ZEPHIR_RETURN_CALL_METHOD(_2, "invokeargs", NULL, args);
	zephir_check_call_status();
	RETURN_MM();

}

PHP_METHOD(Auryn_Invokable, getCallableReflection) {


	RETURN_MEMBER(this_ptr, "reflFunc");

}

PHP_METHOD(Auryn_Invokable, getInvocationObject) {


	RETURN_MEMBER(this_ptr, "invokeObj");

}

PHP_METHOD(Auryn_Invokable, isInstanceMethod) {


	RETURN_MEMBER(this_ptr, "isInstanceMethod");

}

