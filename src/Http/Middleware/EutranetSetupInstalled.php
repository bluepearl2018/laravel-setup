<?php

namespace Eutranet\Setup\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Schema;
use Flash;

class EutranetSetupInstalled
{
	public function handle($request, Closure $next)
	{
		if (!Schema::hasTable('countries')) {
			Flash::error('Please install Eutranet setup package.');
			return redirect()->route('install');
		}
		return $next($request);
	}
}
