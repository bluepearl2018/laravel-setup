<?php

namespace Eutranet\Setup\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Storage;
use Str;
use function redirect;
use function view;
use function event;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('theme::auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // If auth checked, log out the creating user... Never knows
        if (Auth::check()) {
            Auth::logout();
            Flash::warning(trans('Never knows...'));
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email:rfc,dns', 'required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country_id' => 'exists:countries,id',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'nif' => 'required|numeric|min:1|max:999999999'
        ]);

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'country_id' => $request->country_id ?? null,
                'phone' => $request->phone,
                'nif' => $request->nif
            ]
        );

        // If the new user is a
        Storage::makeDirectory('/user-files/' . $user->id . '-' . Str::slug($user->name));
        Storage::makeDirectory('/user-files/' . $user->id . '-' . Str::slug($user->name) . "/img");
        Storage::makeDirectory('/user-files/' . $user->id . '-' . Str::slug($user->name) . "/pdf");
        Storage::makeDirectory('/user-files/' . $user->id . '-' . Str::slug($user->name) . "/documents");

        event(new Registered($user));

        Auth::login($user);

        if (Auth::guard('staff')) {
            return redirect(RouteServiceProvider::STAFF);
        } elseif (Auth::guard('admin')) {
            Flash::success('You have created a new user.');
            return redirect(RouteServiceProvider::SETUP);
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
