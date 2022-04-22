<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Flash;
use Eutranet\Setup\Repository\Eloquent\SetupStepRepository;
use Artisan;
use Eutranet\Setup\Models\SetupProcess;
use Eutranet\Setup\Models\SetupStep;
use Illuminate\Contracts\Foundation\Application;

/**
 * The setup step controller allows the super admin to complete setup steps.
 *
 */
class SetupStepController extends Controller
{

	/**
	 * Access granted to super-admin role
	 */
	public function __construct(SetupStepRepository $setupStepRepository)
	{
		$this->middleware(['role:super-admin']);
		$this->setupStepRepo = $setupStepRepository;
	}

	/**
	 * @param SetupProcess|null $setupProcess
	 * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function index(?SetupProcess $setupProcess): Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	{
		return view('setup::setup-steps.index', ['setupProcess' => $setupProcess, 'setupSteps' => $this->setupStepRepo->all()]);
	}

	/**
	 * @param Request $request
	 * @param SetupProcess|null $setupProcess
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request, ?SetupProcess $setupProcess): \Illuminate\Http\RedirectResponse
	{
		$rules = [
			'setup_process_id' => 'exists:setup_processes, id',
			'name' => 'string|max:255',
			'description' => 'string|max:1024',
			'console_action' => 'string|max:255',
			'console_check' => 'string|max:255',
			'is_complete' => 'boolean',
		];
		$validated = $request->validate($rules);
		$setupStep = SetupStep::firstOrCreate($validated);
		return redirect()->route('setup.laravel-setup-steps.show', $setupStep);
	}

	/**
	 * @param SetupProcess|null $setupProcess
	 * @param SetupStep $setupStep
	 * @return Factory|View|Application
	 */
	public function show(?SetupProcess $setupProcess, SetupStep $setupStep): Factory|View|Application
	{
		return view('laravel-setup.laravel-setup-steps.show', ['setupProcess' => $setupProcess, 'setupStep' => $setupStep]);
	}

	/**
	 * @param SetupProcess|null $setupProcess
	 * @param SetupStep $setupStep
	 * @return Factory|View|Application
	 */
	public function edit(?SetupProcess $setupProcess, SetupStep $setupStep): Factory|View|Application
	{
		return view('laravel-setup.laravel-setup-steps.edit', ['setupProcess' => $setupProcess, 'setupStep' => $setupStep]);
	}


	/**
	 * @param Request $request
	 * @param SetupProcess|null $setupProcess
	 * @param SetupStep $setupStep
	 * @return RedirectResponse
	 */
	public function update(Request $request, ?SetupProcess $setupProcess, SetupStep $setupStep): RedirectResponse
	{
		$rules = [
			'setup_process_id' => 'exists:setup_processes, id',
			'name' => 'string|max:255',
			'description' => 'string|max:1024',
			'console_action' => 'string|max:255',
			'console_check' => 'string|max:255',
			'is_complete' => 'boolean',
		];
		$request->validate($rules);
		return redirect()->route('setup.laravel-setup-steps.show', $setupStep);
	}

	/**
	 * @param Request $request
	 * @param SetupStep $setupStep
	 * @return RedirectResponse
	 */
	public function run(Request $request, SetupStep $setupStep): RedirectResponse
	{
		Auth::user()->hasPermissionTo('update-laravel-setup-step');
		Artisan::call($setupStep->console_action);
		$setupStep->update(['is_complete' => true]);
		Flash::success('Command ' . $setupStep->console_action . ' executed.');
		return redirect()->back();
	}

	/**
	 * @param Request $request
	 * @param SetupStep $setupStep
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function setComplete(Request $request, SetupStep $setupStep): \Illuminate\Http\RedirectResponse
	{
		Auth::user()->hasPermissionTo('update-laravel-setup-step');
		$setupStep->update(['is_complete' => true]);
		Flash::success('Step set complete');
		return redirect()->back();
	}

}
