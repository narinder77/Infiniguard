<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\EmailDistributionList;
use Illuminate\Support\Facades\Validator;

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
            $emails = EmailDistributionList::all('id', 'email', 'created_at');
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
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:email_distribution_lists',
                'name' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()->toArray(),
                ], 422); 
            }

            $emailDistributionList = EmailDistributionList::create($request->all());
    
            return response()->json([
                'message' => 'Email Added successfully',
                'code' => 201
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $validator->errors(), 
                'code' => $e->getCode()
            ], 500); 
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
    public function edit(EmailDistributionList $emailDistributionList)
    {
        if ($emailDistributionList) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $emailDistributionList
            ]);
        } else {
            return response()->json([
                'message' => "Email Distribution List not found",
                "code"    => 404
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailDistributionList $emailDistributionList)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray(),
            ], 422); 
        }

        $emailDistributionList->update($request->all());

        return response()->json([
            'message' => 'Email Distribution List updated successfully',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailDistributionList $emailDistributionList)
    {
        $emailDistributionList->delete();

        return response()->json([
            'message' => 'Email Distribution List deleted successfully',
            'code' => 200
        ]);
    }
}
