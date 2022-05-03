<?php

namespace Eutranet\Setup\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Setup\Repository\Eloquent\PermissionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\Permission;
use Illuminate\Http\Request;
use Eutranet\Setup\Models\Guard;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Str;

class RoleHasPermissionController extends Controller
{
    //
}
