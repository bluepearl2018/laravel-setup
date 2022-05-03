<?php

namespace Eutranet\Setup\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsDataOfficer
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Auth::guard('admin')->id() === 2) {
            Flash::warning('Make sure to activate the maintenance mode with a secret key... command is php artisan down --secret="key". Get the domain.tld/key to access the site.');
            return $next($request);
        }
        return abort('403');
    }
}
