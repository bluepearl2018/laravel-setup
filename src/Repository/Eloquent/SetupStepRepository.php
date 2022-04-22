<?php

namespace Eutranet\Setup\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use JetBrains\PhpStorm\Pure;
use Schema;
use Flash;
use Eutranet\Setup\Models\SetupStep;
use Eutranet\Setup\Models\Role;
use Eutranet\Setup\Models\Permission;
use Eutranet\Setup\Models\Admin;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

/**
 *
 */
class SetupStepRepository extends BaseRepository implements EutranetSetupInterface
{
	protected mixed $adminRepo;
	protected mixed $staffRepo;

	/**
	 * Setup Setp Repository constructor.
	 *
	 * @param SetupStep $model
	 * @param AdminRepository $adminRepository
	 */

	#[Pure] public function __construct(
		SetupStep       $model,
		AdminRepository $adminRepository,
	)
	{
		parent::__construct($model);
		$this->adminRepo = $adminRepository;
	}

	/**
	 * -------------------------------------------------------
	 * CHECKS TO COMPLETE SETUP PROCESS
	 * -------------------------------------------------------
	 * /**
	 * @return bool
	 */
	public function checkRolesTableIsSeeded(): bool
	{
		if (Schema::hasTable('roles')) {
			if (Role::count() > 0) {
				return true;
			}
			Flash::warning('Roles table not seeded');
			return false;
		}
		return false;
	}

	/**
	 * @return bool
	 */
	public function checkPermissionsTableIsSeeded(): bool
	{
		if (Schema::hasTable('permissions')) {
			if (Permission::count() < 1) {
				Flash::warning('Table of permissions was not seeded... Problem being solved.');
				return false;
			}
			return true;
		}
		return false;
	}

	/**
	 * @return bool
	 */
	public function checkSuperAdminIsSet(): bool
	{
		return $this->adminRepo->hasSuperAdmin();
	}


	/**
	 * @return bool
	 */
	public function checkDataOfficerIsSet(): bool
	{
		return $this->adminRepo->hasDataOfficer();
	}


	/**
	 * @return bool
	 */
	public function checkCorporateIsSet(): bool
	{
		if (Schema::hasTable('roles')) {
			if (Role::find(3)?->name === 'corporate' && Admin::find(3)?->hasRole('admin')) {
				return true;
			}
			return false;
		}
		return false;
	}

	/**
	 * @return array
	 */
	public function checkConfigAppParameters(): array
	{
		return $appConfig = array(
			// Application
			'Application - Name' => config('app.name'),
			'Application - Environment ' => config('App.env'),
			'Application - Debug mode is active' => config('App.debug'),
			'Application - Url' => config('App.url'),
			// Authentication
			'Authentication - Guards' => config('auth.guards'),
			// Cache
			'Cache - Cache is provided by' => config('cache.default'),
			// Corporate fallback config
			'Corporate - Name' => config('corporate.name'),
			'Corporate - Full address' => config('corporate.full_address'),
			'Corporate - Postal code' => config('corporate.postal_code'),
			'Corporate - City' => config('corporate.postal_city'),
			'Corporate - Country' => config('corporate.country'),
			'Corporate - General email' => config('corporate.general_email'),
			'Corporate - General phone' => config('corporate.general_phone'),
			'Corporate - Consultation email' => config('corporate.consultation_email'),
			'Corporate - Consultation phone' => config('corporate.consultation_phone'),
			'Corporate - Administration email' => config('corporate.administrator_email'),
			'Corporate - Administration phone' => config('corporate.administrator_phone'),
			// Mail
			'Mailer - The default mailer protocol is...' => config('mail.default'),
			// Session management
			'Session - The session is driven by...' => config('session.driver'),
			'Session - The session should expires on browser close' => config('session.expire_on_close'),
			'Session - The session lifetime in minutes' => config('session.lifetime'),
			// Media library
			'Media library - The maximum file size accepted by the media libray ' => config('media-library.max_file_size'),
			// Roles and permissions
			'Roles and permissions - The permission model is' => config('permission.models.permission'),
			'Roles and permissions - The role model is' => config('permission.models.role'),
			// Translations
			// Localization retrieves translation from
			'Translations - The original application locale is' => config('app.locale'),
			'Translations - The localizator retrieves special strings from following directories' => config('localizator.search.dirs'),
			'Translations - If a translation has not been set for a given locale, following locale will be used instead' => config('translatable.fallback'),
			'Translations - If a translation has not been set for a given locale and the fallback locale any other locale will be chosen instead' => config('translatable.fallback_any')
		);
	}

	/**
	 * @return array
	 */
	public function checkIfSchemaHasEssentialTables(): array
	{
		return array(
			'frontend' => array(
				'Corporate - Information' => Schema::hasTable('corporates') ? 'OK' : 'Copy/Paste, migrate create_corporates_table',
				'Agencies (Sales)' => Schema::hasTable('agencies') ? 'OK' : 'Copy/Paste, migrate create_agencies_table',
				'Corporate Staff (Sales & Marketing)' => Schema::hasTable('corporate_staff') ? 'OK' : 'Copy/Paste, migrate create_corporate_staff_table',
				'Services (Marketing)' => Schema::hasTable('services') ? 'OK' : 'Copy/Paste, migrate create_services_table',
				'Slides (Marketing)' => Schema::hasTable('slides') ? 'OK' : 'Copy/Paste, migrate create_slides_table',
				'Pages (Static pages)' => Schema::hasTable('pages') ? 'OK' : 'Copy/Paste, migrate create_pages_table',
				'Page Categories (Static pages)' => Schema::hasTable('page_categories') ? 'OK' : 'Copy/Paste, migrate create_page_categories_table',
				'Article (news and blogging)' => Schema::hasTable('articles') ? 'OK' : 'Copy/Paste, migrate create_articles_table',
				'Article Categories (news & blogging)' => Schema::hasTable('article_categories') ? 'OK' : 'Copy/Paste, migrate create_articles_categories_table',
				'Tag (news & blogging)' => Schema::hasTable('tags') ? 'OK' : 'Copy/Paste, migrate create_tags_table',
				'Contact (emails)' => Schema::hasTable('emails') ? 'OK' : 'Copy/Paste, migrate create_emails_table',
				'Media (asscociate media to virtually antything)' => Schema::hasTable('media') ? 'OK' : 'Copy/Paste, migrate create_media_table, composer require spatie/laravel-medialibary',
				'Media Collections (set collections in table...)' => Schema::hasTable('media_collections') ? 'OK' : 'Copy/Paste, migrate create_media_collections_table, composer require spatie/laravel-medialibary',
			),
			'setup' => array(
				'Setup process (define setup processes)' => Schema::hasTable('setup_processes') ? 'OK' : 'Upload create_setup_processes_table to migrations',
				'Setup process steps (define setup processes steps)' => Schema::hasTable('setup_steps') ? 'OK' : 'Upload create_setup_steps_table to migrations',
			),
			'navigation' => array(
				'Menus (to store laravel-navigation items and create menus)' => Schema::hasTable('menus') ? 'OK' : 'Upload create_menus_table to migrations',
			),
			'translations' => array(
				'Language Lines (to store localized strings)' => Schema::hasTable('language_lines') ? 'OK' : 'Composer require spatie/laravel-translation-loader',
				'Translatables for the DB' => 'Composer require spatie/laravel-translatable',
			),
			'people tables' => array(
				'Aministrators table' => Schema::hasTable('admins') ? 'OK' : 'Upload create_admins_table to migrations',
				'Staff members table' => Schema::hasTable('staffs') ? 'OK' : 'Upload create_staffs_table to migrations',
				'Users members table' => Schema::hasTable('users') ? 'OK' : 'Upload create_users_table to migrations',
			),
			'user-notifications' => array(
				'Notifications table' => Schema::hasTable('notifications') ? 'OK' : 'php artisan user-notifications:table, php artisan migrate',
			),
			'people management' => array(
				'Permissions table' => Schema::hasTable('permissions') ? 'OK' : 'Composer require spatie/laravel-permission + copy/paste custom create_permissions_table migration',
				'Roles table' => Schema::hasTable('roles') ? 'OK' : 'Composer require spatie/laravel-permission + copy/paste custom create_permissions_table migration',
				'Roles has Permissions table' => Schema::hasTable('role_has_permissions') ? 'OK' : 'Composer require spatie/laravel-permission + copy/paste custom create_permissions_table migration',
				'Model has Roles' => Schema::hasTable('model_has_roles') ? 'OK' : 'Composer require spatie/laravel-permission + copy/paste custom create_permissions_table migration',
				'Model has Permissions' => Schema::hasTable('model_has_permissions') ? 'OK' : 'Composer require spatie/laravel-permission + copy/paste custom create_permissions_table migration',
			),
			'users' => array(
				'User informations (to enhance user account)' => Schema::hasTable('user_infos'),
				'User Social Medias (to enhance user account)' => Schema::hasTable('user_user_social_medias'),
				'User Statuses (upgrade or downgrade acess to functionalities according status)' => Schema::hasTable('user_statuses'),
			)
		);
	}

	/**
	 * -------------------------------------------------------
	 * SOLUTIONS TO COMPLETE SETUP PROCESS
	 * -------------------------------------------------------
	 * @param Admin $superadmin
	 * @return void
	 */
	public function assignSuperAdminRole(Admin $superadmin)
	{
		$role = Role::where('name', 'super-admin')->get()->first();
		if ($role) {
			$superadmin = Admin::find(1);
			$superadmin?->assignRole($role);
		}
	}

	/**
	 * @param Admin $dataOfficer
	 * @return void
	 */
	public function assignDataOfficerRole(Admin $dataOfficer)
	{
		if (Role::where('name', 'data-officer')->get()->first() !== NULL) {
			$dataOfficer = Admin::find(2);
			// Assign the Data officer role to the second admin
			$dataOfficer?->assignRole(['data-officer']);
		}
	}

	/**
	 * @param Admin $ceo
	 * @return void
	 */
	public function assignCorporateRole(Admin $ceo)
	{
		if (Role::where('name', 'corporate')->get()->first() !== NULL) {
			$ceo = Admin::find(3)->assignRole(['corporate']);
		}
	}

	/**
	 * @param Admin $admin
	 * @return void
	 */
	public function assignAdminRole(Admin $admin)
	{
		if (Role::where('name', 'admin')->get()->first() !== NULL) {
			// Assign the Data officer role to the second admin
			$admin->assignRole(['admin']);
		}
	}
}
