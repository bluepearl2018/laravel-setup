<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Eutranet\Setup\Repository\Eloquent\ModelDocRepository;
use Auth;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\ModelDoc;
use Eutranet\Setup\Models\Admin\SetupStep;

/**
 * This controller allows admins update model documentation after installation
 */
class ModelDocController extends Controller
{
	private ModelDocRepository $modelDocRepo;

	/**
	 * Is protected and intended to those installing application
	 */
	public function __construct(ModelDocRepository $modelDocRepository)
	{
		$this->middleware(['role:super-admin']);
		$this->modelDocRepo = $modelDocRepository;
	}

	/**
	 * @return Application|Factory|View
	 */
	public function index(): View|Factory|Application
	{
		return view('setup.model-docs.index', [
			'modelDocs' => ModelDoc::all()
		]);
	}

	/**
	 * @param ModelDoc $modelDoc
	 * @return Factory|View|Application
	 */
	public function show(ModelDoc $modelDoc): Factory|View|Application
	{
		return view('setup.model-docs.show', [
			'modelDoc' => $modelDoc
		]);
	}

	/**
	 * @param Request $request
	 * @param ModelDoc $modelDoc
	 * @return RedirectResponse
	 */
	public function store(Request $request, ModelDoc $modelDoc): RedirectResponse
	{
		$rules = [
			'table_name' => 'string|max:255',
			'slug' => 'string|max:255',
			'name' => 'string|max:255',
			'namespace' => 'string|max:255',
			'description' => 'string|max:2048',
			'comment' => 'string|max:2048',
		];
		$validated = $request->validate($rules);
		ModelDoc::firstOrCreate($validated);
		return redirect()->route('setup.model-docs.show', $modelDoc);
	}

	/**
	 * @param ModelDoc $modelDoc
	 * @return Application|Factory|View
	 */
	public function edit(ModelDoc $modelDoc): View|Factory|Application
	{
		return view('setup.model-docs.edit', [
			'modelDoc' => $modelDoc
		]);
	}

	/**
	 * @param Request $request
	 * @param ModelDoc $modelDoc
	 * @return RedirectResponse
	 */
	public function update(Request $request, ModelDoc $modelDoc): RedirectResponse
	{
		$rules = [
			'table_name' => 'string|max:255',
			'slug' => 'string|max:255',
			'name' => 'string|max:255',
			'namespace' => 'string|max:255',
			'description' => 'string|max:2048',
			'comment' => 'string|max:2048',
		];
		$validated = $request->validate($rules);
		$modelDoc->update($validated);
		return redirect()->route('setup.model-docs.show', $modelDoc);
	}

	/**
	 * @param Request $request
	 * @param SetupStep $setupStep
	 * @return RedirectResponse
	 */
	public function restoreDefaults(Request $request, SetupStep $setupStep): RedirectResponse
	{
		Auth::user()->hasPermissionTo('update-model-doc');
		$models = $this->modelDocRepo->getModels('Models');
		return redirect()->back();
	}
}
