<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Setup\Repository\Eloquent\GeneralTermRepository;

/**
 * This controller allows admins to create and update general terms
 */
class GeneralTermController extends Controller
{
	private GeneralTermRepository $generalTermRepo;

	public function __construct(GeneralTermRepository $generalTermRepository)
	{
		$this->middleware(['role:admin']);
		$this->generalTermRepo = $generalTermRepository;
	}

	public function index()
	{
		return view('setup::corporates.index', [
			'generalTerms' => $this->generalTermRepo->all()
		]);
	}
}
