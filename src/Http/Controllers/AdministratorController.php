<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use function view;
use function abort;
use Eutranet\Setup\Models\Admin;
use Auth;

/**
 * AdministratorController should allow super admin management except SUPER ADMIN
 */
class AdministratorController extends Controller
{
	/**
	 * Visitiros of called pages should BE SUPERADMIN.
	 */
	public function __construct()
	{
		$this->middleware('super-admin');
		$this->middleware('auth:admin');
	}

	/**
	 * @return Application|Factory|View
	 */
	public function index(): Factory|View|Application
	{
		return view('setup::admins.index', ['admins' => Admin::all()]);
	}

	/**
	 * @param Admin $admin
	 * @return Application|Factory|View
	 */
	public function show(Admin $admin): Factory|View|Application
	{
		if (Auth::check()) {
			if ($admin->id !== Auth::id()) {
				return view('setup::admins.show', ['admin' => $admin]);
			}
		}
		return abort('403', 'Hard code or die.');
	}
}
