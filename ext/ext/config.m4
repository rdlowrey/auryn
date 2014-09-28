PHP_ARG_ENABLE(auryn, whether to enable auryn, [ --enable-auryn   Enable Auryn])

if test "$PHP_AURYN" = "yes"; then
	AC_DEFINE(HAVE_AURYN, 1, [Whether you have Auryn])
	auryn_sources="auryn.c kernel/main.c kernel/memory.c kernel/exception.c kernel/hash.c kernel/debug.c kernel/backtrace.c kernel/object.c kernel/array.c kernel/extended/array.c kernel/string.c kernel/fcall.c kernel/require.c kernel/file.c kernel/operators.c kernel/concat.c kernel/variables.c kernel/filter.c kernel/iterator.c kernel/exit.c auryn/abstractinjector.zep.c
	auryn/cachingreflector.zep.c
	auryn/exception.zep.c
	auryn/injectorexception.zep.c
	auryn/invokable.zep.c
	auryn/reflectioncacheapc.zep.c
	auryn/reflectioncachearray.zep.c
	auryn/reflectioncacheinterface.zep.c
	auryn/reflectioncachememcached.zep.c
	auryn/reflectorinterface.zep.c
	auryn/standardreflector.zep.c "
	PHP_NEW_EXTENSION(auryn, $auryn_sources, $ext_shared)

	old_CPPFLAGS=$CPPFLAGS
	CPPFLAGS="$CPPFLAGS $INCLUDES"

	AC_CHECK_DECL(
		[HAVE_BUNDLED_PCRE],
		[
			AC_CHECK_HEADERS(
				[ext/pcre/php_pcre.h],
				[
					PHP_ADD_EXTENSION_DEP([auryn], [pcre])
					AC_DEFINE([ZEPHIR_USE_PHP_PCRE], [1], [Whether PHP pcre extension is present at compile time])
				],
				,
				[[#include "main/php.h"]]
			)
		],
		,
		[[#include "php_config.h"]]
	)

	AC_CHECK_DECL(
		[HAVE_JSON],
		[
			AC_CHECK_HEADERS(
				[ext/json/php_json.h],
				[
					PHP_ADD_EXTENSION_DEP([auryn], [json])
					AC_DEFINE([ZEPHIR_USE_PHP_JSON], [1], [Whether PHP json extension is present at compile time])
				],
				,
				[[#include "main/php.h"]]
			)
		],
		,
		[[#include "php_config.h"]]
	)

	CPPFLAGS=$old_CPPFLAGS
fi
