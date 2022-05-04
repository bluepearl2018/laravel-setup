<?php

namespace Eutranet\Setup\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function redirect;
use function view;
use Eutranet\Setup\Providers\SetupRouteServiceProvider;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param Request $request
     * @return View|Factory|Application|RedirectResponse
     */
    public function __invoke(Request $request): View|Factory|Application|RedirectResponse
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(SetupRouteServiceProvider::MYSPACE)
            : view('theme::auth.verify-email');
    }
}
