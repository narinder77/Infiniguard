<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class LoginController extends Controller
{
    public function create()
    {
        $page_title = 'Login';
        $page_description = 'Some description for the page';
        return view('admin.auth.login', compact('page_title', 'page_description'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        /*$email = $request->provider_email;
        $password = md5($request->provider_password);

        $remember = $request->has('remember') ? true : false;
        if (Auth::guard('admin')->attempt(['provider_email' => $email, 'password' => $password], $remember)) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }*/
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
