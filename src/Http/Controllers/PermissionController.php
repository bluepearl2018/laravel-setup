<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Setup\Repository\Eloquent\PermissionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\Permission;
use Illuminate\Http\Request;
use Eutranet\Setup\Models\Guard;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;

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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View
	 */
	public function create(): Factory|View|Application
	{
		$permissionPrefixes = ['list', 'create', 'read', 'update', 'delete', 'translate'];
		return view('setup::permissions.create', ['permissionPrefixes' => $permissionPrefixes]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 * @return Application|Factory|View
	 */
	public function store(Request $request): Factory|View|Application
	{
		$permission = Permission::firstOrCreate(
			$request->except('_token')
		);
		return $this->show($permission);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Permission $permission
	 * @return Application|Factory|View
	 */
	public function show(Permission $permission): Factory|View|Application
	{
		return view('setup::permissions.show', ['permission' => $permission]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Permission $permission
	 * @return Application|Factory|View
	 */
	public function edit(Permission $permission): Factory|View|Application
	{
		return view('setup::permissions.edit', ['permission' => $permission]);
	}

	/**
	 * Update the resource.
	 *
	 * @param Request $request
	 * @param Permission $permission
	 * @return Application|Factory|View
	 */
	public function update(Request $request, Permission $permission): Factory|View|Application
	{
		$permission->update($request->except('token'));
		return $this->show($permission);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Permission $permission
	 * @return RedirectResponse
	 */
	public function destroy(Permission $permission) : RedirectResponse
	{
		$permission->delete();
		return redirect(route('setup.permissions.index'));
	}
}
