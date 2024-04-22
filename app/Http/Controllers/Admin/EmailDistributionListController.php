<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailDistributionList;
use Illuminate\Http\Request;

class EmailDistributionListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = 'Email Distribution List';
        $page_description = 'Some description for the page';
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailDistributionList $emailDistributionList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailDistributionList $emailDistributionList)
    {
        //
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
