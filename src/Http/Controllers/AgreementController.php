<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Flash;
use Eutranet\Setup\Models\Agreement;

/**
 *
 */
class AgreementController extends Controller
{
	/**
	 * Corporate agreements are to be modified by the HR manager??
	 */
	public function __construct()
	{
		// $this->middleware(['auth:admin']);
	}

	/**
	 * @return Factory|View|Application
	 */
	public function index(): Factory|View|Application
	{
		if(Auth::user()->can('list-agreements')) {
			$agreements = Agreement::all();
			return view('setup::agreements.index', ['agreements' => $agreements]);
		}
		return abort('403', 'You do not have the permission to list agreements');
	}

	/**
	 * @return Factory|View|Application
	 */
	public function create(): Factory|View|Application
	{
		if(Auth::user()->can('create-agreements')) {
			return view('setup::agreements.create');
		}
		return abort('403', 'You do not have the permission to create agreements');
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		if(Auth::user()->can('create-agreements')) {
			$rules = [
				'name' => 'string|max:255',
				'description' => 'string|max:140',
				'lead' => 'string|max:512',
				'general_terms' => 'string|max:2048',
			];
			$validated = $request->validate($rules);
			$agreement = Agreement::create($validated);
			return redirect(route('admin.agreements.show', $agreement));
		}
		return abort('403', 'You do not have the permission to save agreements');
	}

	/**
	 * @param Agreement $agreement
	 * @return Factory|View|Application
	 */
	public function show(Agreement $agreement): Factory|View|Application
	{
		if(Auth::user()->can('read-agreements')) {
			return view('setup::agreements.show', ['agreement' => $agreement]);
		}
		return abort('403', 'You do not have the permission to display agreements');
	}

	/**
	 * @param Agreement $agreement
	 * @return Factory|View|Application
	 */
	public function edit(Agreement $agreement): Factory|View|Application
	{

		if(Auth::user()->can('update-agreements')) {
			return view('setup::agreements.edit', ['agreement' => $agreement]);
		}
		return abort('403', 'You do not have the permission to edit agreements');
	}

	/**
	 * @param Request $request
	 * @param Agreement $agreement
	 * @return RedirectResponse
	 */
	public function update(Request $request, Agreement $agreement): RedirectResponse
	{
		if(Auth::user()->can('update-agreements')) {
			$rules = [
				'name' => 'string|max:255',
				'description' => 'string|max:140',
				'lead' => 'string|max:512',
				'general_terms' => 'string|max:8096',
			];
			$validated = $request->validate($rules);
			$agreement->update($validated);
			return redirect(route('setup.agreements.show', $agreement));
		}
		return abort('403', 'You do not have the permission to update agreements');
	}

	/**
	 * @param Request $request
	 * @param Agreement $agreement
	 * @return Redirector|Application|RedirectResponse
	 */
	public function destroy(Request $request, Agreement $agreement): Redirector|Application|RedirectResponse
	{
		if(Auth::user()->can('delete-agreements')) {
			$agreement->delete();
			Flash::success('Agreement deleted');
			return redirect(route('admin.agreements.index'));
		}
		return abort('403', 'You do not have the permission to delete agreements');
	}
}