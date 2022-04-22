<?php

namespace Eutranet\Setup\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Eutranet\Setup\Models\DocCategory;

/**
 * The Doc controller is for application developers.
 * Normally, the documentation is provided in English.
 */
class DocController extends Controller
{

	/**
	 * Developpement documents are made accessible to
	 * Administrators only. The original documentation can be updated.
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
		// $this->authorizeResource(App\Models\Doc::class);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Application|Factory|View
	 */
	public function create(): View|Factory|Application
	{
		return view('docs.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @param DocCategory $docCategory
	 * @return Application|Factory|View
	 */
	public function store(Request $request, DocCategory $docCategory): View|Factory|Application
	{
		$rules = [
			'slug' => 'required|string|max:255',
			'doc_category_id' => 'required|exists:doc_categories,id',
			'meta_description' => 'nullable|string|max:155',
			'meta_title' => 'required|string|max:255',
			'title' => 'required|string|max:255',
			'lead' => 'required|string|max:300',
			'body' => 'required|string',
			'admin_id' => 'nullable|exists:admins,id',
		];
		$validated = $request->validate($rules);
		$doc = Doc::firstOrCreate($validated);
		return view('docs.show', ['doc' => $doc]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param DocCategory|null $docCategory
	 * @param Doc $doc
	 * @return Application|Factory|View
	 */
	public function show(?DocCategory $docCategory, Doc $doc): View|Factory|Application
	{
		App::setLocale('fr');
		return view('docs.show', ['doc' => $doc]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param DocCategory|null $docCategory
	 * @param Doc $doc
	 * @return Application|Factory|View
	 */
	public function edit(?DocCategory $docCategory, Doc $doc): View|Factory|Application
	{
		return view('docs.edit', ['docCategory' => $docCategory, 'doc' => $doc]);
	}

	/**
	 * Update the specified resource in storage.
	 * A document cannot be updated without calling the document category
	 * @param Request $request
	 * @param DocCategory $docCategory
	 * @param Doc $doc
	 * @return Application|Factory|View
	 */
	public function update(Request $request, DocCategory $docCategory, Doc $doc): Application|Factory|View
	{
		$rules = [
			'slug' => 'required|string|max:255',
			'doc_category_id' => 'required|exists:doc_categories,id',
			'meta_description' => 'nullable|string|max:155',
			'meta_title' => 'required|string|max:255',
			'title' => 'required|string|max:255',
			'lead' => 'required|string|max:300',
			'body' => 'required|string',
			'admin_id' => 'nullable|exists:admins,id',
		];
		$validated = $request->validate($rules);
		$doc->update($validated);
		return view('docs.show', ['doc' => $doc]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Doc $doc
	 * @return Application|Factory|View
	 */
	public function destroy(Doc $doc): View|Factory|Application
	{
		$doc->delete();
		return $this->index();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View
	 */
	public function index(): Factory|View|Application
	{
		$docs = Doc::all();
		return view('docs.index', ['docs' => $docs]);
	}
}
