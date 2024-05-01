<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function create(){
        $page_title = 'Page Forgot Password';
        $page_description = 'Some description for the page';
        return view('admin.auth.forgot-password', compact('page_title', 'page_description'));
    }
    public function store(Request $request)
    {
        
    }    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['provider_email' => 'required|email']);

        $status = Password::broker('admins')->sendResetLink(['provider_email' => $request->provider_email]);

        //  dd($status,Password::RESET_LINK_SENT);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['provider_email' => __($status)]);
    }
}
