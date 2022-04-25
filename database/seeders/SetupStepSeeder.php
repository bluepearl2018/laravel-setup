<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Database\Seeder;

class SetupStepSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

//		$setupSteps = [
//			// Fresh install
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Composer update',
//				'description' => 'Upload the application composer.json and run $ composer update',
//				'comment' => NULL,
//				'console_action' => NULL,
//				'config_path' => 'root/composer.json',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Install and update NPM',
//				'description' => 'The package.json file, with following json array.',
//				'comment' => '',
//				'console_action' => NULL,
//				'config_path' => 'package.json',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Tailwind Config',
//				'description' => 'Make sure tailwindcss and dependencies are installed.',
//				'comment' => 'The config file should mention the defaultTheme css or other. Furthermore, some tailwind.ui components are required.',
//				'console_action' => NULL,
//				'config_path' => 'tailwind.config.js',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Web pack mix.js',
//				'description' => 'Should have the tailwindcss, postcss-import, autoprefixer',
//				'comment' => '$ npm run development.',
//				'console_action' => NULL,
//				'config_path' => '.webpack.mix.js',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Setup Environment',
//				'description' => 'Check the production .env file',
//				'comment' => 'Make sure the env parameters are compatible with the dot env library.',
//				'console_action' => NULL,
//				'config_path' => '.env',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Check resource css/app.css',
//				'description' => 'Some imports to be made... tailwindcss/base, tailwindcss/components, tailwindcss/utilities', 'swiper/swiper-bundle.css',
//				'comment' => 'Components css to be mixed from nodes',
//				'console_action' => NULL,
//				'config_path' => NULL,
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Check resource js/app.js',
//				'description' => 'Customize app.js, import and upload script files',
//				'comment' => NULL,
//				'console_action' => NULL,
//				'config_path' => NULL,
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 1,
//				'name' => 'Run npm',
//				'description' => 'Install and run npm to compile css...',
//				'comment' => 'Update composer',
//				'console_action' => NULL,
//				'config_path' => NULL,
//				'is_complete' => false,
//			),
//			// File uploads
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload installation Console',
//				'description' => 'Console that will be used throughout the common installation process.',
//				'comment' => 'Most of the commands are associated with seeders.',
//				'console_action' => NULL,
//				'config_path' => 'App/Console/Console',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Customize the console kernel',
//				'description' => 'Load commands from subfolders, define scheduled tasks...',
//				'comment' => 'The schedule:work or schedule:run should be tested in order to cron some tasks',
//				'console_action' => NULL,
//				'config_path' => 'App/Console/Kernel.php',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Check the Http kernel',
//				'description' => 'Define middlewares... and CHECK server post max size',
//				'comment' => 'The schedule:work or schedule:run should be tested in order to cron some tasks',
//				'console_action' => NULL,
//				'config_path' => 'App/Http/Kernel.php',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload middlewares',
//				'description' => 'Middlewares should be the one mentioned in kernel.php',
//				'comment' => 'Please note middlewares are called from RouteServiceProvider...',
//				'console_action' => NULL,
//				'config_path' => 'App/Http/Middleware',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload custom controllers',
//				'description' => 'All controllers should copied and pasted into Http/Controllers',
//				'comment' => 'The schedule:work or schedule:run should be tested in order to cron some tasks',
//				'console_action' => NULL,
//				'config_path' => 'App/Http/Controllers',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload specific requests',
//				'description' => 'The Auth login request is essential when using multiple guards. More parameters can be added if needed and for security purposes.',
//				'comment' => 'The login strategy should be reviewed in config/auth.php',
//				'console_action' => NULL,
//				'config_path' => 'App/Requests',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload mailer classes',
//				'description' => 'Upload all Mail subfolders...',
//				'comment' => 'This should be made available as a package.',
//				'console_action' => NULL,
//				'config_path' => 'App/Mail',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload custom models',
//				'description' => 'Models placed in this folder will automatically be documentated in the model_docs...',
//				'comment' => 'Models should be uploaded according the project needs.',
//				'console_action' => NULL,
//				'config_path' => 'App/Models',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Upload the user-notifications',
//				'description' => 'Standard notification classes are associated with notification templates...',
//				'comment' => 'Notifications should be bundled in thematic packages.',
//				'console_action' => NULL,
//				'config_path' => 'App/Notifications',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 2,
//				'name' => 'Configure the service providers',
//				'description' => 'Providers should be registerd in config/App.php. Add EventServiceProvider and SetupServiceProvider ...',
//				'comment' => 'In RouteServiceProvider, all extra route files have middleware web, so that one can access the ad hoc login routes. Other middlewares are then applied on route groups. RepositoryServiceProvider for ad hoc bindings...',
//				'console_action' => NULL,
//				'config_path' => 'App/Providers',
//				'is_complete' => false,
//			),
//
//			// Application configuration
//			array(
//				'setup_process_id' => 3,
//				'name' => 'Start install',
//				'description' => 'Install and run npm to compile...',
//				'comment' => 'Update composer',
//				'console_action' => 'su:start-install',
//				'config_path' => NULL,
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 3,
//				'name' => 'Seed "model_docs" table',
//				'description' => 'This loads the initial documentation, like model documentations.',
//				'comment' => 'Update composer',
//				'console_action' => 'su:seed-model-docs',
//				'config_path' => NULL,
//				'is_complete' => false
//			),
//			array(
//				'setup_process_id' => 3,
//				'name' => 'Seed "roles" table',
//				'description' => 'Save roles into DB "roles" table. Roles are defined in RoleSeeder with appropriate guard...',
//				'comment' => 'Update composer',
//				'console_action' => 'su:seed-roles',
//				'config_path' => NULL,
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 3,
//				'name' => 'Seed "permissions" table',
//				'description' => 'Save permissions into DB "permissions" table. Permissions are set in PermissionSeeder with appropriate guard... Please note this has to be discussed with the customer first.',
//				'comment' => 'Update composer',
//				'console_action' => 'su:seed-permissions',
//				'config_path' => 'permission',
//				'is_complete' => false,
//			),
//			array(
//				'setup_process_id' => 3,
//				'name' => 'Config "mailer"',
//				'description' => 'The mailer configuration file is available from config folder.',
//				'comment' => 'Update composer',
//				'console_action' => 'su:config-mail',
//				'config_path' => 'mail',
//				'is_complete' => false,
//			)
//		];
//		DB::table('setup_steps')->insert(
//			$setupSteps
//		);
	}
}
