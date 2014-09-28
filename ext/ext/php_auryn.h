
/* This file was generated automatically by Zephir do not modify it! */

#ifndef PHP_AURYN_H
#define PHP_AURYN_H 1

#define ZEPHIR_RELEASE 1

#include "kernel/globals.h"

#define PHP_AURYN_NAME        "auryn"
#define PHP_AURYN_VERSION     "0.0.1"
#define PHP_AURYN_EXTNAME     "auryn"
#define PHP_AURYN_AUTHOR      ""
#define PHP_AURYN_ZEPVERSION  "0.5.2a"
#define PHP_AURYN_DESCRIPTION ""



ZEND_BEGIN_MODULE_GLOBALS(auryn)

	/* Memory */
	zephir_memory_entry *start_memory; /**< The first preallocated frame */
	zephir_memory_entry *end_memory; /**< The last preallocate frame */
	zephir_memory_entry *active_memory; /**< The current memory frame */

	/* Virtual Symbol Tables */
	zephir_symbol_table *active_symbol_table;

	/** Function cache */
	HashTable *fcache;

	/* Max recursion control */
	unsigned int recursive_lock;

	/* Global constants */
	zval *global_true;
	zval *global_false;
	zval *global_null;
	
ZEND_END_MODULE_GLOBALS(auryn)

#ifdef ZTS
#include "TSRM.h"
#endif

ZEND_EXTERN_MODULE_GLOBALS(auryn)

#ifdef ZTS
	#define ZEPHIR_GLOBAL(v) TSRMG(auryn_globals_id, zend_auryn_globals *, v)
#else
	#define ZEPHIR_GLOBAL(v) (auryn_globals.v)
#endif

#ifdef ZTS
	#define ZEPHIR_VGLOBAL ((zend_auryn_globals *) (*((void ***) tsrm_ls))[TSRM_UNSHUFFLE_RSRC_ID(auryn_globals_id)])
#else
	#define ZEPHIR_VGLOBAL &(auryn_globals)
#endif

#define zephir_globals_def auryn_globals
#define zend_zephir_globals_def zend_auryn_globals

extern zend_module_entry auryn_module_entry;
#define phpext_auryn_ptr &auryn_module_entry

#endif
