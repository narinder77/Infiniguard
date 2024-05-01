<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\EmailDistributionList;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EmailDistribution\StoreEmailDistributionRequest;
use App\Http\Requests\EmailDistribution\UpdateEmailDistributionRequest;

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
    public function store(StoreEmailDistributionRequest $request)
    {
        try {
            $emailDistributionList = EmailDistributionList::create($request->validated());
            return response()->json([
                'message' => 'Email Added successfully',
                'code' => 201
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => [], 
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
    public function update(UpdateEmailDistributionRequest $request, EmailDistributionList $emailDistributionList)
    {

        $emailDistributionList->update($request->validated());

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
