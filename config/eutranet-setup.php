<?php
return [
	'name' => config('app.name'),
	'baseline' => 'Software development and internationalization',

	// Tables for the laravel-setup
	'tables' => [
		'admins',
		'staffs',
		'agreements',
		'model_docs',
		'setup_processes',
		'setup-steps',
	],

	/*
	|--------------------------------------------------------------------------
	| Middlewares
	|--------------------------------------------------------------------------
	|µ
	|
	*/
	'middlewares' => array(
		'web',
		'setup-migrated',
		// 'role:super-admin'
	),
];