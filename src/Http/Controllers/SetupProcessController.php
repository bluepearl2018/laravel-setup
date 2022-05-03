<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Config;
use Illuminate\Http\RedirectResponse;
use Eutranet\Setup\Repository\Eloquent\SetupStepRepository;

/**
 * The databasase controller makes sure all required tables exist.
 *
 */
class SetupProcessController extends Controller
{
    /**
     *
     */
    protected SetupStepRepository $setuStepRepo;
    /**
     *
     */
    public function __construct(SetupStepRepository $setupStepRepository)
    {
        $this->middleware(['auth:admin']);
        $this->setupStepRepo = $setupStepRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('setup::checks.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function configCorporate(): Application|Factory|View
    {
        $corporate = config('corporate');
        return view('setup::config.corporate', compact('corporate'));
    }
}
