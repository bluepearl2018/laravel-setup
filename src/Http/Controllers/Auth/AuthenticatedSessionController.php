<?php

namespace Eutranet\Setup\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Eutranet\Setup\Providers\SetupRouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('theme::auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (class_exists('Eutranet\Setup\Models\StaffMember') && Auth::guard('staff')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(SetupRouteServiceProvider::BACKEND);
        } elseif (class_exists('Eutranet\Setup\Models\Admin') && Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(SetupRouteServiceProvider::SETUP);
        } elseif (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(SetupRouteServiceProvider::MYSPACE);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('web')) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Flash::warning('WEB LOGGED OUT');
            return redirect(route('goodbye.user'));
        } elseif (Auth::guard('staff')) {
            Auth::guard('staff')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Flash::warning('STAFF LOGGED OUT');
            return redirect(route('goodbye.staff'));
        } elseif (Auth::guard('admin')) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Flash::warning('ADMIN LOGGED OUT');
            return redirect(route('goodbye.setup'));
        }
        return abort('500', 'Not logged out');
    }
}
