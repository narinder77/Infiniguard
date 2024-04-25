<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\EmailDistributionList;

class EmailDistributionListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Email Distribution List';
        $page_description = 'Some description for the page';
        
        if ($request->ajax()) {
            $emails = EmailDistributionList::all('id','email','created_at');
            return DataTables::of($emails)
                ->toJson();
        }
		return view('admin.email-distributions.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([ // Validate input
            'email' => 'required|email', // Example validation rules
        ]);
        $result = EmailDistributionList::create($data);
        if($result) {
            return response()->json([
                'message' => "Record created successfully",
                "code"    => 200
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, EmailDistributionList $emailDistributionList)
    {
        $result = EmailDistributionList::findOrFail($request->id);
        if($result) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $result
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailDistributionList $emailDistributionList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailDistributionList $emailDistributionList)
    {
        //
    }
}
