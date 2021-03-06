<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Eutranet\Corporate\Repository\Eloquent\AgencyRepository;
use Eutranet\Corporate\Repository\Eloquent\CorporateRepository;
use Eutranet\Setup\Repository\Eloquent\GeneralTermRepository;
use Eutranet\Setup\Repository\Eloquent\PermissionRepository;
use Eutranet\Setup\Repository\Eloquent\RoleRepository;
use Eutranet\Setup\Models\ModelDoc;
use function view;

class DashboardController extends Controller
{
    /**
     * Inject essential setup checks, so that solution can be installed properly
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        $userCount = User::count();
        $users = User::latest()->take('5')->get();
        $setupChecks = ['1' => 'rjkdz'];

        return view('setup::dashboard', [
            'modelDocs' => ModelDoc::all(),
            'userCount' => $userCount,
            'users' => $users,
            'lastFiveUsers' => $users,
            'setupChecks' => $setupChecks
        ]);
    }
}
