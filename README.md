# Javascript errors handler for Yii2 framework

This module catches all frontend javascript errors, sends error info with AJAX request and saves this data to database.

## Installation

Run to install extension:

	composer require tunect/yii2-js-error-handler

Run migration:

	./yii migrate

*It's possible to add custom migration paths since Yii2 2.0.10 (module adds it's path in tunect\Yii2JsErrorHandler\Bootstrap file)*

That's it, module will work. Additional settings are optional.

## Module settings

To specify module name (default name is `js-error-handler`) set it in index.php or in config file (before config goes to Application constructor):

	\tunect\Yii2JsErrorHandler\Module::$moduleName = 'custom-js-error-handler';

Module settings can be changed in app config:

	'modules' => [
		'js-error-handler' => [
			'class' => 'tunect\Yii2JsErrorHandler\Module',
			'tableName' => '{{%custom_table_name}}',
		],
	],

*Note: Settings should be specified both in web and console app configs since this module has a migration. Or you can use common config, merge config parts, etc.*

## Errors info

Errors grid view available on page `/js-error-handler` (the name module was registred with, if you changed `Module::$moduleName` - use your value as a path).

## TODO

* Implement controller access control customisation
* Implement errors search
* Implement delete / batch delete for errors
