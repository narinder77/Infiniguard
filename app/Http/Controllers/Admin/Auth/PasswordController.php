<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function create(){
        $page_title = 'Change Password';
        $page_description = 'Some description for the page';
        return view('admin.auth.change-password', compact('page_title', 'page_description'));
    }
    public function update(){

    }
}
