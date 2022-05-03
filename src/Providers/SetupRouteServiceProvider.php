<?php

namespace Eutranet\Setup\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as BaseRouteServiceProvider;

class SetupRouteServiceProvider extends BaseRouteServiceProvider
{
    /**
     * The path to the "home" routes for your application.
     * This is used by Laravel authentication to redirect
     * a web, staff and setup user after login.
     */

    /**
     * @var string
     */
    public const MYSPACE = '/my-space/dashboard';
    /**
     * @var string
     */
    public const STAFF = '/admin/dashboard';
    /**
     * @var string
     */
    public const SETUP = '/setup/dashboard';
    /**
     * @var string
     */
    public const BACKEND = '/backend/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            // Todo check essential route files
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('deletions', function (Request $request) {
            return Limit::perMinute(1)->by($request->user()->id);
        });

        RateLimiter::for('restorations', function (Request $request) {
            return Limit::perMinute(1)->by($request->user()->id);
        });
    }
}
