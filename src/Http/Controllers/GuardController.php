<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\Admin;
use Auth;
use function view;
use function abort;

/**
 * Email controller should allow super admin to test email functions
 */
class GuardController extends Controller
{
	/**
	 * Email controller constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

}