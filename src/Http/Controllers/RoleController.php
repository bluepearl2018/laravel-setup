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
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('setup::roles.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => 'string|max:150',
            'guard_name' => 'exists:guards,slug',
            'description' => 'string|max:1024'
        ];
        Role::firstOrCreate($request->validate($rules));
        return redirect()->route('setup.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function show(Role $role): View|Factory|Application
    {
        Auth::user()->hasPermissionTo('read-roles', 'admin');
        return view('setup::roles.show', ['role' => $role, 'modelDocs' => ModelDoc::all()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function edit(Role $role): Factory|View|Application
    {
        return view('setup::roles.edit', ['role' => $role]);
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

    /**
     * Syncrhonize permission for the current role.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function givePermissionTo(Request $request, Role $role): RedirectResponse
    {
        if ($request->permission_id) {
            $role->givePermissionTo($request->permission_id);
        }
        return redirect()->back();
    }

    /**
     * Syncrhonize permission for the current role.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function revokePermissionTo(Request $request, Role $role): RedirectResponse
    {
        if ($request->permission_id) {
            $role->revokePermissionTo($request->permission_id);
        }
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect(route('setup.roles.index'));
    }
}
