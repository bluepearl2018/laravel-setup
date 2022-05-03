<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Eutranet\Setup\Models\DocCategory;

/**
 * The Doc Category controller is intended to application developers.
 * Normally, the documentation is provided in English.
 */
class DocCategoryController extends Controller
{
    /**
     * Developpement documents are made accessible to
     * Administrators only. The original documentation has standard document categories.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->authorizeResource(App\Models\DocCategory::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('setup::doc-categories.index', ['docCategories' => DocCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('setup::doc-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request): View|Factory|Application
    {
        $rules = [
            'slug' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:doc_categories,id',
            'meta_description' => 'nullable|string|max:155',
            'meta_title' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'lead' => 'required|string|max:300',
            'body' => 'required|string',
            'admin_id' => 'nullable|exists:admins,id',
        ];
        $validated = $request->validate($rules);
        $docCategory = DocCategory::firstOrCreate($validated);
        return view('setup::doc-categories.show', ['docCategory' => $docCategory]);
    }

    /**
     * Display the specified resource.
     *
     * @param DocCategory $docCategory
     * @return Application|Factory|View
     */
    public function show(DocCategory $docCategory): View|Factory|Application
    {
        return view('setup::doc-categories.show', ['docCategory' => $docCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DocCategory $docCategory
     * @return Application|Factory|View
     */
    public function edit(DocCategory $docCategory): View|Factory|Application
    {
        return view('setup::doc-categories.edit', ['docCategory' => $docCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param DocCategory $docCategpry
     * @return Application|Factory|View
     */
    public function update(Request $request, DocCategory $docCategpry): Application|Factory|View
    {
        $rules = [
            'slug' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:doc_categories,id',
            'meta_description' => 'nullable|string|max:155',
            'meta_title' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'lead' => 'required|string|max:300',
            'body' => 'required|string',
            'admin_id' => 'nullable|exists:admins,id',
        ];
        $validated = $request->validate($rules);
        $docCategpry->update($validated);
        return view('setup::doc-categories.show', ['docCategpry' => $docCategpry]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DocCategory $docCategpry
     * @return Application|Factory|View
     */
    public function destroy(DocCategory $docCategpry): View|Factory|Application
    {
        $docCategpry->delete();
        return $this->index();
    }
}
