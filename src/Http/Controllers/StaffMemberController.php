<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use function view;
use Eutranet\Setup\Models\StaffMember;
use Illuminate\Http\RedirectResponse;
use Auth;

class StaffMemberController extends Controller
{

	public function __construct()
	{
		// $this->authorizeResource(App\Models\StaffMember::class);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View
	 */
	public function index(): View|Factory|Application
	{
		$staffMembers = StaffMember::paginate(12);
		return view('setup::staff-members.index', ['staffMembers' => $staffMembers]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Application|Factory|View
	 */
	public function create(): View|Factory|Application
	{
		if (Auth::check() && Auth::user()->hasRole(['admin', 'super-staff'])) {
			return view('setup::staff-members.create');
		}
		return abort('403');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		if (Auth::check() && Auth::user()->hasRole(['admin', 'super-staff'])) {
			$rules = [];
			$validated = $request->validate($rules);
			$staffMember = StaffMember::firstOrCreate($validated);
			return redirect()->route('setup::staff-members.show', $staffMember);
		}
		return abort('403');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param StaffMember $staffMember
	 * @return Application|Factory|View
	 */
	public function show(StaffMember $staffMember): View|Factory|Application
	{
		return view('setup::staff-members.show', ['staffMember' => $staffMember]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param StaffMember $staffMember
	 * @return Application|Factory|View
	 */
	public function edit(StaffMember $staffMember): View|Factory|Application
	{
		if (Auth::check() && Auth::user()->hasRole(['data-officer', 'super-admin', 'super-staff'])) {
			return view('setup::staff-members.edit', ['staffMember' => $staffMember]);
		}
		return abort('403');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param StaffMember $staffMember
	 * @return RedirectResponse
	 */
	public function update(Request $request, StaffMember $staffMember): RedirectResponse
	{
		if (Auth::check() && Auth::user()->hasRole(['data-officer', 'super-admin', 'super-staff'])) {
			$rules = [
				'login' => 'max:255',
				'country_id' => 'exists:countries,id',
				'representante' => 'nullable|max:50',
				'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
				'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16'
			];
			$validated = $request->validate($rules);
			$staffMember->update($validated);
			return redirect()->route('setup.staff-members.show', $staffMember);
		}
		return abort('403');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param StaffMember $staffMember
	 * @return void
	 */
	public function destroy(StaffMember $staffMember)
	{
		$staffMember->delete();
	}
}
