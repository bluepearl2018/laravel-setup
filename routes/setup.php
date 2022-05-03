<?php

use Eutranet\Setup\Http\Controllers\AdministratorController;
use Eutranet\Setup\Http\Controllers\RoleController;
use Eutranet\Setup\Http\Controllers\DocCategoryController;
use Eutranet\Setup\Http\Controllers\DocController;
use Eutranet\Setup\Http\Controllers\DashboardController;
use Eutranet\Setup\Http\Controllers\SetupProcessController;
use Eutranet\Setup\Http\Controllers\ModelDocController;
use Eutranet\Setup\Http\Controllers\SetupStepController;
use Eutranet\Setup\Http\Controllers\PermissionController;
use Eutranet\Setup\Http\Controllers\Auth\AuthenticatedSessionController;
use Eutranet\Setup\Http\Controllers\AgreementController;
use Eutranet\Setup\Http\Controllers\UserController;
use Eutranet\Setup\Http\Controllers\StaffMemberController;
use Eutranet\Setup\Http\Controllers\RoleHasPermissionController;

Route::middleware(['web', 'guest:admin'])->prefix('setup')->name('setup.')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('authenticate', [AuthenticatedSessionController::class, 'store'])->name('authenticate');
});

Route::middleware(['web', 'auth:admin'])->prefix('setup')->name('setup.')->group(function () {
    Route::redirect('/', 'dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('installation', [SetupProcessController::class, 'index'])->name('installation');
    Route::get('config-corporate', [SetupProcessController::class, 'configCorporate'])->name('config-corporate');

    Route::post('model-docs/restore-defaults', [ModelDocController::class, 'restoreDefaults'])->name('model-docs.restore-defaults');
    Route::resource('model-docs', ModelDocController::class)->names('model-docs');

    Route::post('setup-steps/{setupStep}/set-complete', [SetupStepController::class, 'setComplete'])->name('setup-steps.set-complete');
    Route::post('setup-steps/{setupStep}/run', [SetupStepController::class, 'run'])->name('setup-steps.run');
    Route::resource('setup-steps', SetupStepController::class)->names('setup-steps');

    /**
     * -----------------------------------------------------------------------------
     * UNDER DEVELOPMENT
     * -----------------------------------------------------------------------------
     */
    Route::get('my-profile', function () {
        return abort('403', 'My profile Under development');
    })->name('my-profile');
    Route::get('my-preferences', function () {
        return abort('403', 'My preferences Under development');
    })->name('my-preferences');
    Route::get('my-user-notifications', function () {
        return abort('403', 'My user-notifications Under development');
    })->name('my-user-notifications');
    Route::get('log', function () {
        return abort('403', 'Log viewer Under development');
    })->name('log');
    Route::get('mailer', function () {
        return abort('403', 'Mailer Under development');
    })->name('mailer');
    Route::get('new-users', function () {
        return abort('403', 'New users Under development');
    })->name('new-users');
    Route::get('notify-account-holders', function () {
        return abort('403', 'Notify account holders under development');
    })->name('notify-account-holders');
    Route::get('mail-staff', function () {
        return abort('403', 'Mail staff Under development');
    })->name('mail-staff');

    /**
     * -----------------------------------------------------------------------------
     * MANAGE ADMINISTRATORS, ROLES AND PERMISSIONS
     * -----------------------------------------------------------------------------
     */
    Route::resource('admins', AdministratorController::class)->names('admins');
    Route::resource('admins.permissions', PermissionController::class)->names('admins.permissions');
    Route::put('roles/{role}/sync-permission', [RoleController::class, 'syncPermission'])->name('roles.sync-permission');
    Route::post('roles/{role}/give-permission-to', [RoleController::class, 'givePermissionTo'])->name('roles.give-permission-to');
    Route::post('roles/{role}/revoke-permission-to', [RoleController::class, 'revokePermissionTo'])->name('roles.revoke-permission-to');
    Route::resource('roles', RoleController::class)->names('roles')->scoped([
        'role' => 'name',
    ]);
    Route::resource('role-has-permissions', RoleHasPermissionController::class)->names('role-has-permissions');
    Route::resource('setup-processes', SetupProcessController::class)->names('setup-processes');
    Route::resource('setup-steps', SetupStepController::class)->names('setup-steps');
    Route::resource('staff-members', StaffMemberController::class)->names('staff-members');
    Route::resource('users', UserController::class)->names('users');

    /**
     * -----------------------------------------------------------------------------
     * RESOURCES
     * -----------------------------------------------------------------------------
     *
     * All documents and document categories..
     */
    Route::resource('agreements', AgreementController::class)->names('agreements');
    /*Route::resource('emails', EmailController::class)->names('emails');
    Route::resource('general-terms', GeneralTermController::class)->names('general-terms');
    Route::resource('guards', GuardController::class)->names('guards');*/

    /**
     * ACCOUNTS, ROLES AND PERMISSIONS
     * -----------------------------------------------------------------------------
     *
     * Roles and permission tables can be seeded during the setup stage.
     */
    Route::resource('roles', RoleController::class)->names('roles');
    Route::get('permissions/create-permission-from-action-name/{table_name}', [PermissionController::class, 'createPermissionFromActionName'])->name('permissions.create-permission-from-action-name');
    Route::get('permissions/create-permissions-from-table-name/{table_name}', [PermissionController::class, 'createPermissionsFromTableName'])->name('permissions.create-permissions-from-table-name');
    Route::resource('permissions', PermissionController::class)->names('permissions');
    //	Route::get('seed/roles', [RoleController::class, 'seedRoles'])->name('roles.seed');
    //	Route::get('seed/permissions', [RoleController::class, 'seedPermissions'])->name('permissions.seed');
    Route::resource('roles.permissions', PermissionController::class)->names('roles.permissions');

    /**
     * BACK OFFICE ESSENTIAL DOCUMENTATION
     * -----------------------------------------------------------------------------
     *
     * All documents and document categories..
     */
    Route::resource('doc-categories', DocCategoryController::class)->names('doc-categories');
    Route::resource('docs', DocController::class)->names('docs');
    Route::resource('doc-categories.docs', DocController::class)->names('doc-categories.docs');

    /**
     * MESSAGES
     * -----------------------------------------------------------------------------
     *
     * Account are created internally or from the website.
     * All application users are identified by a UNIQUE EMAIL and TAX ID (nif)
     * Administrators and staff members are not "users", but staff or admins.
     */

//    if (Schema::hasTable('messages')) {
//        Route::get('admins/{admin}/messages/history', [MessageController::class, 'history'])->name('admins.messages.history');
//    }
});
