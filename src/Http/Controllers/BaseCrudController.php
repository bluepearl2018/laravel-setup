<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;
use Eutranet\Commons\Models\Language;

/**
 * The Base Crud Controller is used as a template by all common ressource controller.
 * Nobody should access the resources except the admins, since they are allowed to modify and update
 * common App resource contents..
 */
abstract class BaseCrudController extends Controller
{

	/**
	 * @var string
	 */
	private string $resourceName;
	/**
	 * @var string
	 */
	private string $pluralResourceName;
	/**
	 * @var string
	 */
	private string $viewPath;
	/**
	 * @var mixed
	 */
	private mixed $model;
	/**
	 * @var
	 */
	private $defaultLanguage;
	/**
	 * @var string
	 */
	private string $tableName;

	/**
	 * @param $model
	 * @param $viewPath
	 * @param $resourceName
	 * @param $tableName
	 */
	public function __construct($model, $viewPath, $resourceName, $tableName)
	{
		$this->middleware('auth:admin');
		$this->resourceName = $resourceName;
		$this->tableName = $tableName;
		$this->pluralResourceName = Str::plural($resourceName);
		$this->viewPath = $viewPath;
		$this->model = $model;
		$this->defaultLanguage = Language::where('code', config('app.locale'))->get()->first();
	}

	/**
	 * @return View|Factory|Application
	 */
	public function create(): View|Factory|Application
	{
		return view($this->viewPath . '.create',
			[
				'model' => $this->model,
				'tableName' => $this->tableName,
				'singularTitle' => Str::title($this->resourceName),
				'defaultLanguage' => $this->defaultLanguage->name
			]
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store(Request $request): RedirectResponse
	{
		$newEntry = $this->model->create($this->InputStore($request));
		Flash::success(__('Resource successfully created'));
		return redirect()->route('setup.' . Str::slug($this->tableName) . '.show', $newEntry->id);
	}

	/**
	 * Get the store request validation results
	 *
	 * @param Request $request
	 */
	abstract protected function inputStore(Request $request);

	/**
	 * @param $id
	 * @return Factory|View|Application
	 */
	public function show($id): Factory|View|Application
	{
		return view($this->viewPath . '.show', [
			'singularTitle' => $this->resourceName,
			'tableName' => $this->tableName,
			'model' => $this->model,
			'resource' => $this->model->findOrFail($id),
			'defaultLanguage' => $this->defaultLanguage->name
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @param $id
	 * @return RedirectResponse
	 */
	public function update(Request $request, $id): RedirectResponse
	{
		$model = $this->model->findOrFail($id);
		$model->fill($this->inputUpdate($request));
		$model->save();
		Flash::success(__('Resource successfully updated'));
		return redirect()->route('setup.' . Str::slug($this->tableName) . '.show', $model->id);
	}

	/**
	 * Get the update request validation results
	 *
	 * @param Request $request
	 */
	abstract protected function inputUpdate(Request $request);

	/**
	 * @param $id
	 * @return Factory|View|Application
	 */
	public function destroy($id): Factory|View|Application
	{
		$this->model->destroy($id);
		Flash::success(__('Resource successfully deleted'));
		return $this->index();
	}

	/**
	 * Get the input from the request.
	 */
	public function index(): Factory|View|Application
	{
		return view($this->viewPath . '.index', [
			'entries' => $this->model->orderBy('name', 'ASC')->paginate(),
			'model' => $this->model,
			'tableName' => $this->tableName,
			'singularTitle' => Str::title($this->resourceName),
			'pluralTitle' => Str::title($this->pluralResourceName),
			'defaultLanguage' => $this->defaultLanguage->name
		]);
	}
}
