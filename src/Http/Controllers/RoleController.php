<?php

namespace Eutranet\Setup\Http\Controllers;


use App\Http\Controllers\Controller;
use Eutranet\Setup\Repository\Eloquent\RoleRepository;
use Illuminate\Contracts\Foundation\Application as Application;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;
use Eutranet\Setup\Models\ModelDoc;
use Eutranet\Setup\Models\Role;

class RoleController extends Controller
{
	private RoleRepository $roleRepo;

	/**
	 * Roles can be CRUDed by an administrator.
	 */
	public function __construct(RoleRepository $roleRepository)
	{
		$this->middleware(['auth:admin']);
		$this->roleRepo = $roleRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View
	 */
	public function index(): Factory|View|Application
	{
		$roles = Role::all();
		return view('setup::roles.index', ['roles' => $this->roleRepo->all()]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Role $role
	 * @return Application|Factory|View
	 */
	public function show(Role $role): View|Factory|Application
	{
		Auth::user()->hasPermissionTo('read-role', 'admin');
		return view('setup::roles.show', ['role' => $role, 'modelDocs' => ModelDoc::all()]);
	}

	/**
	 * Syncrhonize permission for the current role.
	 *
	 * @param Request $request
	 * @param Role $role
	 * @return RedirectResponse
	 */
	public function syncPermission(Request $request, Role $role): RedirectResponse
	{

		if ($request->permission) {
			$role->syncPermissions($request->permission);
		}
		return redirect()->back();
	}

}
