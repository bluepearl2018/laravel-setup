<?php

namespace Eutranet\Setup;

use Eutranet\Init\PackageServiceProvider;
use Eutranet\Init\Package;
use Eutranet\Setup\Console\Commands\EutranetInstallSetupCommand;
use Illuminate\Routing\Router;
use Eutranet\Setup\Http\Middleware\EutranetSetupInstalled;
use Eutranet\Setup\Http\Middleware\SetupMigratedMiddleware;
use Eutranet\Setup\View\Components\Logo;
use Eutranet\Setup\View\Composers\SetupConfigComposer;
use Eutranet\Setup\Providers\SetupMenuServiceProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Eutranet\Setup\Providers\SetupRouteServiceProvider;

class SetupServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-setup')
            ->hasConfigFile(['eutranet-setup', 'corporate', 'auth', 'permission']) // php artisan vendor:publish --tag=your-laravel-init-name-config
            ->hasRoutes(['config', 'auth', 'web', 'back', 'setup'])
            ->hasViews('setup') // ->hasViews('custom-view-namespace::myView.subview');
            ->hasMigration('add_description_to_permission_tables')
            ->hasMigration('create_agreements_table')
            ->hasMigration('create_notifications_table')
            ->hasMigration('create_setup_processes_table')
            ->hasMigration('create_setup_steps_table')
            ->hasMigration('create_admins_table')
            ->hasMigration('create_staff_members_table')
            ->hasMigration('create_teams_table')
            ->hasMigration('create_guards_table')
            ->hasMigration('create_general_terms_table')
            ->hasMigration('create_emails_table')
            ->hasMigration('create_model_docs_table')
            ->hasMigration('create_doc_categories_table')
            ->hasMigration('create_docs_table')
            ->hasViewComponent('setup', Logo::class)
            ->hasViewComposer('setup::config', SetupConfigComposer::class)
            // ->hasViewComposer('*', SetupComposer::class)
            ->hasTranslations()
            ->hasAssets()
            ->hasCommand(EutranetInstallSetupCommand::class);
        // ->hasMigration('create_package_tables');
    }

    /**
     * @throws BindingResolutionException
     */
    public function boot()
    {
        parent::boot();

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('setup-migrated', SetupMigratedMiddleware::class);
        $router->aliasMiddleware('setup-installed', EutranetSetupInstalled::class);
        $router->pushMiddlewareToGroup('web', 'setup-migrated');
        $router->pushMiddlewareToGroup('web', 'setup-installed');
    }

    public function register()
    {
        parent::register();
        // ... other things
        //		$this->registerRoutes();
        $this->app->register(SetupRouteServiceProvider::class);
        $this->app->register(SetupMenuServiceProvider::class);
        $this->loadMigrationsFrom(app_path('Eutranet/Setup/database/migrations'));
    }

    protected function registerRoutes()
    {
        //		Route::group($this->routeConfiguration(), function () {
//			$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
//			$this->loadRoutesFrom(__DIR__ . '/../routes/back.php');
//			$this->loadRoutesFrom(__DIR__ . '/../routes/test.php');
//		});
    }

    protected function routeConfiguration(): array
    {
        return [
            // 'middleware' => config('eutranet-setup.middlewares'),
        ];
    }
}
