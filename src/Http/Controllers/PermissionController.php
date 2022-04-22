<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Setup\Repository\Eloquent\PermissionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\Permission;

class PermissionController extends Controller
{
	private PermissionRepository $permissionRepo;

	/**
	 * Permissions can be CRUDed by an administrator.
	 */
	public function __construct(PermissionRepository $permissionRepository)
	{
		$this->middleware(['auth:admin']);
		$this->permissionRepo = $permissionRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View
	 */
	public function index(): Factory|View|Application
	{
		$permissions = Permission::all();
		return view('setup::permissions.index', ['permissions' => $this->permissionRepo->all()]);
	}
}
