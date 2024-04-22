<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
