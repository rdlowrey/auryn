
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
#include "kernel/array.h"
#include "kernel/string.h"

ZEPHIR_INIT_CLASS(Auryn_AbstractInjector) {

	ZEPHIR_REGISTER_CLASS(Auryn, AbstractInjector, auryn, abstractinjector, auryn_abstractinjector_method_entry, ZEND_ACC_EXPLICIT_ABSTRACT_CLASS);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("reflector"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("bindings"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("aliases"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("shares"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("mutators"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("delegates"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("paramDefinitions"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("inProgress"), ZEND_ACC_PROTECTED TSRMLS_CC);

	zend_declare_property_null(auryn_abstractinjector_ce, SL("errorMessages"), ZEND_ACC_PROTECTED|ZEND_ACC_STATIC TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractinjector_ce, SL("A_CLASS"), ":" TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractinjector_ce, SL("A_DELEGATE"), "+" TSRMLS_CC);

	zend_declare_class_constant_string(auryn_abstractinjector_ce, SL("A_DEFINE"), "@" TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("I_BINDINGS"), 1 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("I_DELEGATES"), 2 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("I_MUTATORS"), 4 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("I_ALIASES"), 8 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("I_SHARES"), 16 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("I_ALL"), 17 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_NON_EMPTY_STRING_ALIAS"), 1 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_SHARED_CANNOT_ALIAS"), 2 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_SHARE_ARGUMENT"), 3 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_ALIASED_CANNOT_SHARE"), 4 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_INVOKABLE"), 5 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_NON_PUBLIC_CONSTRUCTOR"), 6 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_NEEDS_DEFINITION"), 7 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_MAKE_FAILURE"), 8 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_UNDEFINED_PARAM"), 9 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_DELEGATE_ARGUMENT"), 10 TSRMLS_CC);

	zend_declare_class_constant_long(auryn_abstractinjector_ce, SL("E_CYCLIC_DEPENDENCY"), 11 TSRMLS_CC);

	return SUCCESS;

}

PHP_METHOD(Auryn_AbstractInjector, __construct) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_bool _0;
	zval *reflector = NULL, *_1, *_2, *_3, *_4, *_5, *_6, *_7, *_8, *_9, *_10 = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 0, 1, &reflector);

	if (!reflector) {
		reflector = ZEPHIR_GLOBAL(global_null);
	}


	_0 = Z_TYPE_P(reflector) != IS_NULL;
	if (_0) {
		_0 = !zephir_instance_of_ev(reflector, auryn_reflectorinterface_ce TSRMLS_CC);
	}
	if (_0) {
		ZEPHIR_THROW_EXCEPTION_DEBUG_STR(spl_ce_InvalidArgumentException, "Parameter 'reflector' must be an instance of 'Auryn\\\\ReflectorInterface'", "", 0);
		return;
	}
	ZEPHIR_INIT_VAR(_1);
	array_init(_1);
	zephir_update_property_this(this_ptr, SL("inProgress"), _1 TSRMLS_CC);
	ZEPHIR_INIT_VAR(_2);
	array_init(_2);
	zephir_update_property_this(this_ptr, SL("paramDefinitions"), _2 TSRMLS_CC);
	ZEPHIR_INIT_VAR(_3);
	array_init(_3);
	zephir_update_property_this(this_ptr, SL("delegates"), _3 TSRMLS_CC);
	ZEPHIR_INIT_VAR(_4);
	array_init(_4);
	zephir_update_property_this(this_ptr, SL("mutators"), _4 TSRMLS_CC);
	ZEPHIR_INIT_VAR(_5);
	array_init(_5);
	zephir_update_property_this(this_ptr, SL("shares"), _5 TSRMLS_CC);
	ZEPHIR_INIT_VAR(_6);
	array_init(_6);
	zephir_update_property_this(this_ptr, SL("aliases"), _6 TSRMLS_CC);
	ZEPHIR_INIT_VAR(_7);
	array_init(_7);
	zephir_update_property_this(this_ptr, SL("bindings"), _7 TSRMLS_CC);
	if (unlikely(Z_TYPE_P(reflector) == IS_NULL)) {
		ZEPHIR_INIT_VAR(_8);
		object_init_ex(_8, auryn_cachingreflector_ce);
		ZEPHIR_CALL_METHOD(NULL, _8, "__construct", NULL);
		zephir_check_call_status();
		zephir_update_property_this(this_ptr, SL("reflector"), _8 TSRMLS_CC);
	} else {
		zephir_update_property_this(this_ptr, SL("reflector"), reflector TSRMLS_CC);
	}
	_9 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
	if (unlikely(ZEPHIR_IS_EMPTY(_9))) {
		ZEPHIR_INIT_VAR(_10);
		ZVAL_STRING(_10, "Invalid alias: non-empty string required at both Argument 1 and Argument 2", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 1);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Cannot alias class %s to %s: it is already shared", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 2);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "%s::share() requires a string class name or object instance at Argument 1; %s specified", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 3);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Cannot share class %s, it has already been aliased to %s", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 4);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Invalid invokable: callable or provisional string required", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 5);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Cannot instantiate class %s; constructor method is protected/private", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 6);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Injection definition/implementation required for non-concrete parameter $%s of type %s", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 7);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Could not make %s: %s", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 8);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "No definition available while attempting to provision typeless non-concrete parameter %s(%s)", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 9);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "%s::delegate expects a valid callable or provisionable executable class or method reference at Argument 2", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 10);
		ZEPHIR_INIT_NVAR(_10);
		ZVAL_STRING(_10, "Detected a cyclic dependency while provisioning %s", 1);
		zephir_update_static_property_array_multi_ce(auryn_abstractinjector_ce, SL("errorMessages"), &_10 TSRMLS_CC, SL("l"), 1, 11);
	}
	ZEPHIR_MM_RESTORE();

}

/**
 * Bind instantiation directives for the specified class
 *
 * @param string name The class (or alias) whose constructor arguments we wish to bind
 * @param array args An array mapping parameter names to values/instructions
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, bind) {

	zephir_nts_static zephir_fcall_cache_entry *_0 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *args = NULL;
	zval *name_param = NULL, *args_param = NULL, *value = NULL, *normalizedName = NULL;
	zval *name = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &name_param, &args_param);

	if (unlikely(Z_TYPE_P(name_param) != IS_STRING && Z_TYPE_P(name_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'name' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(name_param) == IS_STRING)) {
		name = name_param;
	} else {
		ZEPHIR_INIT_VAR(name);
		ZVAL_EMPTY_STRING(name);
	}
	zephir_get_arrval(args, args_param);


	ZEPHIR_CALL_METHOD(&value, this_ptr, "resolvealias", NULL, name);
	zephir_check_call_status();
	Z_SET_ISREF_P(value);
	ZEPHIR_CALL_FUNCTION(&normalizedName, "end", &_0, value);
	Z_UNSET_ISREF_P(value);
	zephir_check_call_status();
	zephir_update_property_array(this_ptr, SL("bindings"), normalizedName, args TSRMLS_CC);
	RETURN_THIS();

}

/**
 * Assign a global default value for all parameters named $paramName
 *
 * Global parameter definitions are only used for parameters with no typehint, pre-defined or
 * call-time definition.
 *
 * @param string paramName The parameter name for which this value applies
 * @param mixed value The value to inject for this parameter name
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, bindParam) {

	zval *paramName_param = NULL, *value;
	zval *paramName = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &paramName_param, &value);

	if (unlikely(Z_TYPE_P(paramName_param) != IS_STRING && Z_TYPE_P(paramName_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'paramName' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(paramName_param) == IS_STRING)) {
		paramName = paramName_param;
	} else {
		ZEPHIR_INIT_VAR(paramName);
		ZVAL_EMPTY_STRING(paramName);
	}


	zephir_update_property_array(this_ptr, SL("paramDefinitions"), paramName, value TSRMLS_CC);
	RETURN_THIS();

}

/**
 * Define an alias for all occurrences of a given typehint
 *
 * Use this method to specify implementation classes for interface and abstract class typehints.
 *
 * @param string original The typehint to replace
 * @param string alias The implementation name
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, alias) {

	zephir_nts_static zephir_fcall_cache_entry *_13 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zend_bool _0, _6;
	zval *original_param = NULL, *alias_param = NULL, *originalNormalized = NULL, *aliasNormalized = NULL, *_1, *_2 = NULL, *_3, *_4, *_5 = NULL, *_7 = NULL, *_8, *_9 = NULL, *_10, *_11, *_12 = NULL;
	zval *original = NULL, *alias = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &original_param, &alias_param);

	if (unlikely(Z_TYPE_P(original_param) != IS_STRING && Z_TYPE_P(original_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'original' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(original_param) == IS_STRING)) {
		original = original_param;
	} else {
		ZEPHIR_INIT_VAR(original);
		ZVAL_EMPTY_STRING(original);
	}
	if (unlikely(Z_TYPE_P(alias_param) != IS_STRING && Z_TYPE_P(alias_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'alias' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(alias_param) == IS_STRING)) {
		alias = alias_param;
	} else {
		ZEPHIR_INIT_VAR(alias);
		ZVAL_EMPTY_STRING(alias);
	}


	_0 = ZEPHIR_IS_EMPTY(original);
	if (!(_0)) {
		ZEPHIR_INIT_VAR(_1);
		zephir_gettype(_1, original TSRMLS_CC);
		_0 = !ZEPHIR_IS_STRING(_1, "string");
	}
	if (_0) {
		ZEPHIR_INIT_VAR(_2);
		object_init_ex(_2, auryn_injectorexception_ce);
		_3 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_4, _3, 1, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 108 TSRMLS_CC);
		ZEPHIR_INIT_VAR(_5);
		ZVAL_LONG(_5, 1);
		ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL, _4, _5);
		zephir_check_call_status();
		zephir_throw_exception_debug(_2, "auryn/abstractinjector.zep", 110 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	_6 = ZEPHIR_IS_EMPTY(alias);
	if (!(_6)) {
		ZEPHIR_INIT_NVAR(_5);
		zephir_gettype(_5, alias TSRMLS_CC);
		_6 = !ZEPHIR_IS_STRING(_5, "string");
	}
	if (_6) {
		ZEPHIR_INIT_LNVAR(_2);
		object_init_ex(_2, auryn_injectorexception_ce);
		_3 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_4, _3, 1, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 115 TSRMLS_CC);
		ZEPHIR_INIT_VAR(_7);
		ZVAL_LONG(_7, 1);
		ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL, _4, _7);
		zephir_check_call_status();
		zephir_throw_exception_debug(_2, "auryn/abstractinjector.zep", 117 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	ZEPHIR_CALL_METHOD(&originalNormalized, this_ptr, "normalizename", NULL, original);
	zephir_check_call_status();
	_3 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
	if (zephir_array_isset(_3, originalNormalized)) {
		ZEPHIR_INIT_LNVAR(_2);
		object_init_ex(_2, auryn_injectorexception_ce);
		_8 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_4, _8, 2, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 125 TSRMLS_CC);
		ZEPHIR_INIT_NVAR(_5);
		_10 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
		zephir_array_fetch(&_11, _10, originalNormalized, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 126 TSRMLS_CC);
		zephir_get_class(_5, _11, 0 TSRMLS_CC);
		ZEPHIR_CALL_METHOD(&_9, this_ptr, "normalizename", NULL, _5);
		zephir_check_call_status();
		ZEPHIR_CALL_FUNCTION(&_12, "sprintf", &_13, _4, _9, alias);
		zephir_check_call_status();
		ZEPHIR_INIT_NVAR(_7);
		ZVAL_LONG(_7, 2);
		ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL, _12, _7);
		zephir_check_call_status();
		zephir_throw_exception_debug(_2, "auryn/abstractinjector.zep", 130 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	_3 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
	if (zephir_array_key_exists(_3, originalNormalized TSRMLS_CC)) {
		ZEPHIR_CALL_METHOD(&aliasNormalized, this_ptr, "normalizename", NULL, alias);
		zephir_check_call_status();
		zephir_update_property_array(this_ptr, SL("shares"), aliasNormalized, ZEPHIR_GLOBAL(global_null) TSRMLS_CC);
		_8 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
		zephir_array_unset(&_8, originalNormalized, PH_SEPARATE);
	}
	zephir_update_property_array(this_ptr, SL("aliases"), originalNormalized, alias TSRMLS_CC);
	RETURN_THIS();

}

PHP_METHOD(Auryn_AbstractInjector, normalizeName) {

	zval *className_param = NULL, *_0, _1;
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
	ZEPHIR_SINIT_VAR(_1);
	ZVAL_STRING(&_1, "\\", 0);
	zephir_fast_trim(return_value, _0, &_1, ZEPHIR_TRIM_LEFT TSRMLS_CC);
	RETURN_MM();

}

/**
 * Share the specified class/instance across the Injector context
 *
 * @param mixed $nameOrInstance The class or object to share
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, share) {

	zephir_nts_static zephir_fcall_cache_entry *_6 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *nameOrInstance, *_0, *_1, *_2, *_3, _4, *_5 = NULL, *_7;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &nameOrInstance);



	if (Z_TYPE_P(nameOrInstance) == IS_STRING) {
		ZEPHIR_CALL_METHOD(NULL, this_ptr, "shareclass", NULL, nameOrInstance);
		zephir_check_call_status();
	} else {
		if (Z_TYPE_P(nameOrInstance) == IS_OBJECT) {
			ZEPHIR_CALL_METHOD(NULL, this_ptr, "shareinstance", NULL, nameOrInstance);
			zephir_check_call_status();
		} else {
			ZEPHIR_INIT_VAR(_0);
			object_init_ex(_0, auryn_injectorexception_ce);
			_1 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
			zephir_array_fetch_long(&_2, _1, 3, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 165 TSRMLS_CC);
			ZEPHIR_INIT_VAR(_3);
			zephir_gettype(_3, nameOrInstance TSRMLS_CC);
			ZEPHIR_SINIT_VAR(_4);
			ZVAL_STRING(&_4, "AbstractInjector", 0);
			ZEPHIR_CALL_FUNCTION(&_5, "sprintf", &_6, _2, &_4, _3);
			zephir_check_call_status();
			ZEPHIR_INIT_VAR(_7);
			ZVAL_LONG(_7, 3);
			ZEPHIR_CALL_METHOD(NULL, _0, "__construct", NULL, _5, _7);
			zephir_check_call_status();
			zephir_throw_exception_debug(_0, "auryn/abstractinjector.zep", 170 TSRMLS_CC);
			ZEPHIR_MM_RESTORE();
			return;
		}
	}
	RETURN_THIS();

}

/**
 * @param mixed nameOfInstance
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, shareClass) {

	zephir_nts_static zephir_fcall_cache_entry *_0 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *nameOrInstance, *value = NULL, *normalizedName = NULL, *_1;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &nameOrInstance);



	ZEPHIR_CALL_METHOD(&value, this_ptr, "resolvealias", NULL, nameOrInstance);
	zephir_check_call_status();
	Z_SET_ISREF_P(value);
	ZEPHIR_CALL_FUNCTION(&normalizedName, "end", &_0, value);
	Z_UNSET_ISREF_P(value);
	zephir_check_call_status();
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
	if (!(unlikely(zephir_array_isset(_1, normalizedName)))) {
		zephir_update_property_array(this_ptr, SL("shares"), normalizedName, ZEPHIR_GLOBAL(global_null) TSRMLS_CC);
	}
	RETURN_THIS();

}

/**
 * @param string name
 * @return array
 */
PHP_METHOD(Auryn_AbstractInjector, resolveAlias) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *name_param = NULL, *key, *normalizedName = NULL, *_0;
	zval *name = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &name_param);

	if (unlikely(Z_TYPE_P(name_param) != IS_STRING && Z_TYPE_P(name_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'name' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(name_param) == IS_STRING)) {
		name = name_param;
	} else {
		ZEPHIR_INIT_VAR(name);
		ZVAL_EMPTY_STRING(name);
	}


	ZEPHIR_CALL_METHOD(&normalizedName, this_ptr, "normalizename", NULL, name);
	zephir_check_call_status();
	ZEPHIR_OBS_VAR(key);
	_0 = zephir_fetch_nproperty_this(this_ptr, SL("aliases"), PH_NOISY_CC);
	if (zephir_array_isset_fetch(&key, _0, normalizedName, 0 TSRMLS_CC)) {
		ZEPHIR_CALL_METHOD(&normalizedName, this_ptr, "normalizename", NULL, key);
		zephir_check_call_status();
	}
	array_init_size(return_value, 3);
	zephir_array_fast_append(return_value, name);
	zephir_array_fast_append(return_value, normalizedName);
	RETURN_MM();

}

/**
 * @param mixed obj
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, shareInstance) {

	zephir_nts_static zephir_fcall_cache_entry *_8 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *obj, *normalizedName = NULL, *_0, *_1, *_2, *_3, *_4, *_5, *_6, *_7 = NULL, *_9;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &obj);



	ZEPHIR_INIT_VAR(_0);
	zephir_get_class(_0, obj, 0 TSRMLS_CC);
	ZEPHIR_CALL_METHOD(&normalizedName, this_ptr, "normalizename", NULL, _0);
	zephir_check_call_status();
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("aliases"), PH_NOISY_CC);
	if (zephir_array_isset(_1, normalizedName)) {
		ZEPHIR_INIT_VAR(_2);
		object_init_ex(_2, auryn_injectorexception_ce);
		_3 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_4, _3, 4, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 220 TSRMLS_CC);
		_5 = zephir_fetch_nproperty_this(this_ptr, SL("aliases"), PH_NOISY_CC);
		zephir_array_fetch(&_6, _5, normalizedName, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 223 TSRMLS_CC);
		ZEPHIR_CALL_FUNCTION(&_7, "sprintf", &_8, _4, normalizedName, _6);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(_9);
		ZVAL_LONG(_9, 4);
		ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL, _7, _9);
		zephir_check_call_status();
		zephir_throw_exception_debug(_2, "auryn/abstractinjector.zep", 225 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	zephir_update_property_array(this_ptr, SL("shares"), normalizedName, obj TSRMLS_CC);
	RETURN_THIS();

}

/**
 * Register a mutator callable to modify/prepare objects of type $name after instantiation
 *
 * Any callable or provisionable invokable may be specified. Preparers are passed two
 * arguments: the instantiated object to be mutated and the current Injector instance.
 *
 * @param string name
 * @param mixed callableOrMethodStr Any callable or provisionable invokable method
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, mutate) {

	zephir_nts_static zephir_fcall_cache_entry *_5 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *name_param = NULL, *callableOrMethodStr, *value = NULL, *normalizedName = NULL, *_0 = NULL, *_1, *_2, *_3, *_4;
	zval *name = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &name_param, &callableOrMethodStr);

	if (unlikely(Z_TYPE_P(name_param) != IS_STRING && Z_TYPE_P(name_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'name' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(name_param) == IS_STRING)) {
		name = name_param;
	} else {
		ZEPHIR_INIT_VAR(name);
		ZVAL_EMPTY_STRING(name);
	}


	ZEPHIR_CALL_METHOD(&_0, this_ptr, "isinvokable", NULL, callableOrMethodStr);
	zephir_check_call_status();
	if (!(zephir_is_true(_0))) {
		ZEPHIR_INIT_VAR(_1);
		object_init_ex(_1, auryn_injectorexception_ce);
		_2 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_3, _2, 5, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 248 TSRMLS_CC);
		ZEPHIR_INIT_VAR(_4);
		ZVAL_LONG(_4, 5);
		ZEPHIR_CALL_METHOD(NULL, _1, "__construct", NULL, _3, _4);
		zephir_check_call_status();
		zephir_throw_exception_debug(_1, "auryn/abstractinjector.zep", 250 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	ZEPHIR_CALL_METHOD(&value, this_ptr, "resolvealias", NULL, name);
	zephir_check_call_status();
	Z_SET_ISREF_P(value);
	ZEPHIR_CALL_FUNCTION(&normalizedName, "end", &_5, value);
	Z_UNSET_ISREF_P(value);
	zephir_check_call_status();
	zephir_update_property_array(this_ptr, SL("mutators"), normalizedName, callableOrMethodStr TSRMLS_CC);
	RETURN_THIS();

}

/**
 * @param mixed exe
 * @return boolean
 */
PHP_METHOD(Auryn_AbstractInjector, isInvokable) {

	zend_bool _0, _1;
	zval *exe, *_2, *_3;

	zephir_fetch_params(0, 1, 0, &exe);



	_0 = Z_TYPE_P(exe) == IS_OBJECT;
	if (_0) {
		_0 = zephir_is_callable(exe TSRMLS_CC);
	}
	if (_0) {
		RETURN_BOOL(1);
	}
	_1 = Z_TYPE_P(exe) == IS_STRING;
	if (_1) {
		_1 = (zephir_method_exists_ex(exe, SS("__invoke") TSRMLS_CC) == SUCCESS);
	}
	if (_1) {
		RETURN_BOOL(1);
	}
	if (Z_TYPE_P(exe) == IS_ARRAY) {
		if (zephir_array_isset_long(exe, 0)) {
			if (zephir_array_isset_long(exe, 1)) {
				zephir_array_fetch_long(&_2, exe, 0, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 277 TSRMLS_CC);
				zephir_array_fetch_long(&_3, exe, 1, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 277 TSRMLS_CC);
				if ((zephir_method_exists(_2, _3 TSRMLS_CC)  == SUCCESS)) {
					RETURN_BOOL(1);
				}
			}
		}
	}
	RETURN_BOOL(0);

}

/**
 * Delegate the creation of $name instances to the specified callable
 *
 * @param string name
 * @param mixed callableOrMethodStr Any callable or provisionable invokable method
 * @return \Auryn\ReflectorInterface
 */
PHP_METHOD(Auryn_AbstractInjector, delegate) {

	zephir_nts_static zephir_fcall_cache_entry *_6 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *name_param = NULL, *callableOrMethodStr, *normalizedName = NULL, *_0 = NULL, *_1, *_2, *_3, _4, *_5 = NULL, *_7;
	zval *name = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &name_param, &callableOrMethodStr);

	if (unlikely(Z_TYPE_P(name_param) != IS_STRING && Z_TYPE_P(name_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'name' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(name_param) == IS_STRING)) {
		name = name_param;
	} else {
		ZEPHIR_INIT_VAR(name);
		ZVAL_EMPTY_STRING(name);
	}


	ZEPHIR_CALL_METHOD(&_0, this_ptr, "isinvokable", NULL, callableOrMethodStr);
	zephir_check_call_status();
	if (!(zephir_is_true(_0))) {
		ZEPHIR_INIT_VAR(_1);
		object_init_ex(_1, auryn_injectorexception_ce);
		_2 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_3, _2, 10, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 300 TSRMLS_CC);
		ZEPHIR_SINIT_VAR(_4);
		ZVAL_STRING(&_4, "AbstractInjector", 0);
		ZEPHIR_CALL_FUNCTION(&_5, "sprintf", &_6, _3, &_4);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(_7);
		ZVAL_LONG(_7, 10);
		ZEPHIR_CALL_METHOD(NULL, _1, "__construct", NULL, _5, _7);
		zephir_check_call_status();
		zephir_throw_exception_debug(_1, "auryn/abstractinjector.zep", 302 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	ZEPHIR_CALL_METHOD(&normalizedName, this_ptr, "normalizename", NULL, name);
	zephir_check_call_status();
	zephir_update_property_array(this_ptr, SL("delegates"), normalizedName, callableOrMethodStr TSRMLS_CC);
	RETURN_THIS();

}

/**
 * Retrieve stored data for the specified definition type
 *
 * Exposes introspection of existing binds/delegates/shares/etc. for decoration and composition.
 *
 * @param string nameFilter An optional class name filter
 * @param int typeFilter A bitmask of Injector::* type constant flags
 * @return array
 */
PHP_METHOD(Auryn_AbstractInjector, inspect) {

	zend_bool _3, _5, _7, _9, _11;
	int typeFilter, ZEPHIR_LAST_CALL_STATUS;
	zval *nameFilter_param = NULL, *typeFilter_param = NULL, *result, *name = NULL, *elements = NULL, *_0, _1, *_2, *_4, *_6, *_8, *_10;
	zval *nameFilter = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 0, 2, &nameFilter_param, &typeFilter_param);

	if (!nameFilter_param) {
		ZEPHIR_INIT_VAR(nameFilter);
		ZVAL_EMPTY_STRING(nameFilter);
	} else {
	if (unlikely(Z_TYPE_P(nameFilter_param) != IS_STRING && Z_TYPE_P(nameFilter_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'nameFilter' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(nameFilter_param) == IS_STRING)) {
		nameFilter = nameFilter_param;
	} else {
		ZEPHIR_INIT_VAR(nameFilter);
		ZVAL_EMPTY_STRING(nameFilter);
	}
	}
	if (!typeFilter_param) {
		typeFilter = 0;
	} else {
		typeFilter = zephir_get_intval(typeFilter_param);
	}


	ZEPHIR_INIT_VAR(result);
	array_init(result);
	if (!(ZEPHIR_IS_EMPTY(nameFilter))) {
		ZEPHIR_CALL_METHOD(&name, this_ptr, "normalizename", NULL, nameFilter);
		zephir_check_call_status();
	} else {
		ZEPHIR_INIT_NVAR(name);
		ZVAL_NULL(name);
	}
	ZEPHIR_INIT_VAR(_0);
	ZEPHIR_SINIT_VAR(_1);
	ZVAL_LONG(&_1, typeFilter);
	zephir_gettype(_0, &_1 TSRMLS_CC);
	if (ZEPHIR_IS_STRING(_0, "null")) {
		typeFilter = 17;
	}
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("bindings"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&elements, this_ptr, "filter", NULL, _2, name);
	zephir_check_call_status();
	_3 = (((typeFilter & 1))) ? 1 : 0;
	if (_3) {
		_3 = zephir_is_true(elements);
	}
	if (_3) {
		zephir_array_update_long(&result, 1, &elements, PH_COPY | PH_SEPARATE, "auryn/abstractinjector.zep", 337);
	}
	_4 = zephir_fetch_nproperty_this(this_ptr, SL("delegates"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&elements, this_ptr, "filter", NULL, _4, name);
	zephir_check_call_status();
	_5 = (((typeFilter & 2))) ? 1 : 0;
	if (_5) {
		_5 = zephir_is_true(elements);
	}
	if (_5) {
		zephir_array_update_long(&result, 2, &elements, PH_COPY | PH_SEPARATE, "auryn/abstractinjector.zep", 342);
	}
	_6 = zephir_fetch_nproperty_this(this_ptr, SL("mutators"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&elements, this_ptr, "filter", NULL, _6, name);
	zephir_check_call_status();
	_7 = (((typeFilter & 4))) ? 1 : 0;
	if (_7) {
		_7 = zephir_is_true(elements);
	}
	if (_7) {
		zephir_array_update_long(&result, 4, &elements, PH_COPY | PH_SEPARATE, "auryn/abstractinjector.zep", 347);
	}
	_8 = zephir_fetch_nproperty_this(this_ptr, SL("aliases"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&elements, this_ptr, "filter", NULL, _8, name);
	zephir_check_call_status();
	_9 = (((typeFilter & 8))) ? 1 : 0;
	if (_9) {
		_9 = zephir_is_true(elements);
	}
	if (_9) {
		zephir_array_update_long(&result, 8, &elements, PH_COPY | PH_SEPARATE, "auryn/abstractinjector.zep", 352);
	}
	_10 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&elements, this_ptr, "filter", NULL, _10, name);
	zephir_check_call_status();
	_11 = (((typeFilter & 16))) ? 1 : 0;
	if (_11) {
		_11 = zephir_is_true(elements);
	}
	if (_11) {
		zephir_array_update_long(&result, 16, &elements, PH_COPY | PH_SEPARATE, "auryn/abstractinjector.zep", 357);
	}
	RETURN_CCTOR(result);

}

PHP_METHOD(Auryn_AbstractInjector, filter) {

	zval *name = NULL;
	zval *source, *name_param = NULL, *_0;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &source, &name_param);

	if (unlikely(Z_TYPE_P(name_param) != IS_STRING && Z_TYPE_P(name_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'name' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(name_param) == IS_STRING)) {
		name = name_param;
	} else {
		ZEPHIR_INIT_VAR(name);
		ZVAL_EMPTY_STRING(name);
	}


	if (ZEPHIR_IS_EMPTY(name)) {
		RETVAL_ZVAL(source, 1, 0);
		RETURN_MM();
	}
	if (zephir_array_isset(source, name)) {
		zephir_array_fetch(&_0, source, name, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 369 TSRMLS_CC);
		RETURN_CTOR(_0);
	}
	array_init(return_value);
	RETURN_MM();

}

/**
 * Instantiate/provision a class instance
 *
 * @param string name
 * @param array args
 * @return mixed
 * @TODO fix call to provisionInstance
 */
PHP_METHOD(Auryn_AbstractInjector, make) {

	zephir_nts_static zephir_fcall_cache_entry *_5 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *args = NULL;
	zval *name_param = NULL, *args_param = NULL, *className, *normalizedClass, *invokable = NULL, *obj = NULL, *resolvedAlias = NULL, *_0, *_1, *_2, *_3, *_4 = NULL, *_6, *_7, *_8;
	zval *name = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 1, &name_param, &args_param);

	if (unlikely(Z_TYPE_P(name_param) != IS_STRING && Z_TYPE_P(name_param) != IS_NULL)) {
		zephir_throw_exception_string(spl_ce_InvalidArgumentException, SL("Parameter 'name' must be a string") TSRMLS_CC);
		RETURN_MM_NULL();
	}

	if (unlikely(Z_TYPE_P(name_param) == IS_STRING)) {
		name = name_param;
	} else {
		ZEPHIR_INIT_VAR(name);
		ZVAL_EMPTY_STRING(name);
	}
	if (!args_param) {
		ZEPHIR_INIT_VAR(args);
		array_init(args);
	} else {
		zephir_get_arrval(args, args_param);
	}


	ZEPHIR_CALL_METHOD(&resolvedAlias, this_ptr, "resolvealias", NULL, name);
	zephir_check_call_status();
	ZEPHIR_OBS_VAR(className);
	zephir_array_fetch_long(&className, resolvedAlias, 0, PH_NOISY, "auryn/abstractinjector.zep", 387 TSRMLS_CC);
	ZEPHIR_OBS_VAR(normalizedClass);
	zephir_array_fetch_long(&normalizedClass, resolvedAlias, 1, PH_NOISY, "auryn/abstractinjector.zep", 388 TSRMLS_CC);
	_0 = zephir_fetch_nproperty_this(this_ptr, SL("inProgress"), PH_NOISY_CC);
	if (zephir_array_isset(_0, normalizedClass)) {
		ZEPHIR_INIT_VAR(_1);
		object_init_ex(_1, auryn_injectorexception_ce);
		_2 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
		zephir_array_fetch_long(&_3, _2, 11, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 393 TSRMLS_CC);
		ZEPHIR_CALL_FUNCTION(&_4, "sprintf", &_5, _3, className);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(_6);
		ZVAL_LONG(_6, 11);
		ZEPHIR_CALL_METHOD(NULL, _1, "__construct", NULL, _4, _6);
		zephir_check_call_status();
		zephir_throw_exception_debug(_1, "auryn/abstractinjector.zep", 397 TSRMLS_CC);
		ZEPHIR_MM_RESTORE();
		return;
	}
	zephir_update_property_array(this_ptr, SL("inProgress"), normalizedClass, ZEPHIR_GLOBAL(global_true) TSRMLS_CC);
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
	if (zephir_array_isset(_2, normalizedClass)) {
		_7 = zephir_fetch_nproperty_this(this_ptr, SL("inProgress"), PH_NOISY_CC);
		zephir_array_unset(&_7, normalizedClass, PH_SEPARATE);
		_8 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
		zephir_array_fetch(&_3, _8, normalizedClass, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 408 TSRMLS_CC);
		RETURN_CTOR(_3);
	}
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("delegates"), PH_NOISY_CC);
	if (zephir_array_isset(_2, normalizedClass)) {
		_7 = zephir_fetch_nproperty_this(this_ptr, SL("delegates"), PH_NOISY_CC);
		zephir_array_fetch(&_3, _7, normalizedClass, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 412 TSRMLS_CC);
		ZEPHIR_CALL_METHOD(&invokable, this_ptr, "makeinvokable", NULL, _3);
		zephir_check_call_status();
		ZEPHIR_CALL_ZVAL_FUNCTION(&obj, invokable, NULL, className, this_ptr);
		zephir_check_call_status();
	} else {
		ZEPHIR_CALL_METHOD(&obj, this_ptr, "provisioninstance", NULL, className, normalizedClass, args);
		zephir_check_call_status();
	}
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("shares"), PH_NOISY_CC);
	if (zephir_array_key_exists(_2, normalizedClass TSRMLS_CC)) {
		zephir_update_property_array(this_ptr, SL("shares"), normalizedClass, obj TSRMLS_CC);
	}
	ZEPHIR_CALL_METHOD(NULL, this_ptr, "mutateinstance", NULL, obj, normalizedClass);
	zephir_check_call_status();
	_2 = zephir_fetch_nproperty_this(this_ptr, SL("inProgress"), PH_NOISY_CC);
	zephir_array_unset(&_2, normalizedClass, PH_SEPARATE);
	RETURN_CCTOR(obj);

}

/**
 * Provision an Invokable instance from any valid callable or class/method string
 *
 * @param mixed $callableOrMethodStr A valid PHP callable or a provisionable ClassName::methodName string
 * @return \Auryn\Invokable
 */
PHP_METHOD(Auryn_AbstractInjector, makeInvokable) {

	int ZEPHIR_LAST_CALL_STATUS;
	zval *callableOrMethodStr, *invokables = NULL, *reflFunc, *invocationObj;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &callableOrMethodStr);



	ZEPHIR_CALL_METHOD(&invokables, this_ptr, "generateinvokables", NULL, callableOrMethodStr);
	zephir_check_call_status();
	zephir_array_fetch_long(&reflFunc, invokables, 0, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 450 TSRMLS_CC);
	zephir_array_fetch_long(&invocationObj, invokables, 1, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 450 TSRMLS_CC);
	object_init_ex(return_value, auryn_invokable_ce);
	ZEPHIR_CALL_METHOD(NULL, return_value, "__construct", NULL, reflFunc, invocationObj);
	zephir_check_call_status();
	RETURN_MM();

}

PHP_METHOD(Auryn_AbstractInjector, generateStringClassMethodCallable) {

	zephir_nts_static zephir_fcall_cache_entry *_5 = NULL;
	int ZEPHIR_LAST_CALL_STATUS;
	zval *className = NULL, *method = NULL, *relativeStaticMethodStartPos, *childReflection = NULL, *reflectionMethod = NULL, _0, *_1, *_2 = NULL, _3, *_4 = NULL;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 2, 0, &className, &method);

	ZEPHIR_SEPARATE_PARAM(className);
	ZEPHIR_SEPARATE_PARAM(method);


	ZEPHIR_SINIT_VAR(_0);
	ZVAL_STRING(&_0, "parent::", 0);
	ZEPHIR_INIT_VAR(relativeStaticMethodStartPos);
	zephir_fast_strpos(relativeStaticMethodStartPos, method, &_0, 0 );
	if (ZEPHIR_IS_LONG(relativeStaticMethodStartPos, 0)) {
		_1 = zephir_fetch_nproperty_this(this_ptr, SL("reflector"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(&childReflection, _1, "getclass", NULL, className);
		zephir_check_call_status();
		ZEPHIR_CALL_METHOD(&_2, childReflection, "getparentclass",  NULL);
		zephir_check_call_status();
		ZEPHIR_OBS_NVAR(className);
		zephir_read_property(&className, _2, SL("name"), PH_NOISY_CC);
		ZEPHIR_SINIT_VAR(_3);
		ZVAL_LONG(&_3, (zephir_get_numberval(relativeStaticMethodStartPos) + 8));
		ZEPHIR_CALL_FUNCTION(&_4, "substr", &_5, method, &_3);
		zephir_check_call_status();
		ZEPHIR_CPY_WRT(method, _4);
	}
	_1 = zephir_fetch_nproperty_this(this_ptr, SL("reflector"), PH_NOISY_CC);
	ZEPHIR_CALL_METHOD(&reflectionMethod, _1, "getmethod", NULL, className, method);
	zephir_check_call_status();
	ZEPHIR_CALL_METHOD(&_2, reflectionMethod, "isstatic",  NULL);
	zephir_check_call_status();
	if (zephir_is_true(_2)) {
		array_init_size(return_value, 3);
		zephir_array_fast_append(return_value, reflectionMethod);
		zephir_array_fast_append(return_value, ZEPHIR_GLOBAL(global_null));
		RETURN_MM();
	}
	array_init_size(return_value, 3);
	zephir_array_fast_append(return_value, reflectionMethod);
	ZEPHIR_CALL_METHOD(&_2, this_ptr, "make", NULL, className);
	zephir_check_call_status();
	zephir_array_fast_append(return_value, _2);
	RETURN_MM();

}

PHP_METHOD(Auryn_AbstractInjector, generateInvokablesFromArray) {

	int ZEPHIR_LAST_CALL_STATUS;
	zend_bool _0;
	zval *arrayInvokable, *classOrObj, *method, *callableRefl = NULL, *invokableArr = NULL, *_1, *_2, *_3, *_4;

	ZEPHIR_MM_GROW();
	zephir_fetch_params(1, 1, 0, &arrayInvokable);



	ZEPHIR_OBS_VAR(classOrObj);
	zephir_array_fetch_long(&classOrObj, arrayInvokable, 0, PH_NOISY, "auryn/abstractinjector.zep", 482 TSRMLS_CC);
	ZEPHIR_OBS_VAR(method);
	zephir_array_fetch_long(&method, arrayInvokable, 1, PH_NOISY, "auryn/abstractinjector.zep", 482 TSRMLS_CC);
	_0 = Z_TYPE_P(classOrObj) == IS_OBJECT;
	if (_0) {
		_0 = (zephir_method_exists(classOrObj, method TSRMLS_CC)  == SUCCESS);
	}
	if (_0) {
		_1 = zephir_fetch_nproperty_this(this_ptr, SL("reflector"), PH_NOISY_CC);
		ZEPHIR_CALL_METHOD(&callableRefl, _1, "getmethod", NULL, classOrObj, method);
		zephir_check_call_status();
		ZEPHIR_INIT_VAR(invokableArr);
		array_init_size(invokableArr, 3);
		zephir_array_fast_append(invokableArr, callableRefl);
		zephir_array_fast_append(invokableArr, classOrObj);
	} else {
		if (Z_TYPE_P(classOrObj) == IS_STRING) {
			ZEPHIR_CALL_METHOD(&invokableArr, this_ptr, "generatestringclassmethodcallable", NULL, classOrObj, method);
			zephir_check_call_status();
		} else {
			ZEPHIR_INIT_VAR(_2);
			object_init_ex(_2, auryn_injectorexception_ce);
			_1 = zephir_fetch_static_property_ce(auryn_abstractinjector_ce, SL("errorMessages") TSRMLS_CC);
			zephir_array_fetch_long(&_3, _1, 5, PH_NOISY | PH_READONLY, "auryn/abstractinjector.zep", 491 TSRMLS_CC);
			ZEPHIR_INIT_VAR(_4);
			ZVAL_LONG(_4, 5);
			ZEPHIR_CALL_METHOD(NULL, _2, "__construct", NULL, _3, _4);
			zephir_check_call_status();
			zephir_throw_exception_debug(_2, "auryn/abstractinjector.zep", 491 TSRMLS_CC);
			ZEPHIR_MM_RESTORE();
			return;
		}
	}
	RETURN_CCTOR(invokableArr);

}

