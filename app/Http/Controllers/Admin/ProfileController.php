<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function edit(Request $request)
    {
        $page_title = 'Edit Profile';
        $page_description = 'Some description for the page';
        return view('admin.profile.edit', compact('page_title', 'page_description'));
    }
    public function update(Request $request)
    {

    }
}
