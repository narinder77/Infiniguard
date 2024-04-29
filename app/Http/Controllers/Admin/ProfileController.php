<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CertifiedProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit(Request $request)
    {
        $id=Auth::guard('admin')->user()->provider_id;

        $certifiedProvider=CertifiedProvider::find($id);
        if($certifiedProvider){
            $page_title = 'Edit Profile';
            $page_description = 'Some description for the page';
            return view('admin.profile.edit', compact('page_title', 'page_description','certifiedProvider'));
        
        }else{
            $page_title = 'Error';
            $page_description = 'Some description for the page';
            return view('errors.404');
        
        }       
      }
    public function update(Request $request)
    {
            
        $request->validate([
            // 'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
    
        try {

            $certifiedProvider=CertifiedProvider::find($request->providerId);      
            // Update password
            $certifiedProvider->provider_password = Hash::make($request->new_password);
            $certifiedProvider->save();

            return response()->json(['status'=>true,'message' => 'Password reset sucessfully!'],200);

        } catch (\Exception $e) {
            // Other errors occurred
            \Log::error($e->getMessage() . ' in ' . $e->getFile() . ' Line No. ' . $e->getLine());
            return response()->json(['status' => false, 'message' => 'An error occurred while reseting password!'], 500);
        }
    }
}
