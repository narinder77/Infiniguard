<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedApplicator;
use App\Http\Controllers\Controller;

class CertifiedApplicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Certified Applicators';
        $page_description = 'Some description for the page';

        if ($request->ajax()) {
            $data = CertifiedApplicator::with(['certifiedProviders'])
                ->withCount('registeredCodes', 'warrantyClaims');
            return DataTables::of($data)
                ->orderColumn('provider_name', function ($query, $order) {
                    $query->join('certified_providers', 'certified_applicators.applicator_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                })->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })->toJson();
        }
        return view('admin.certified-applicators.index', compact('page_title', 'page_description'));
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
    public function show(CertifiedApplicator $certifiedApplicator)
    {
        $page_title = 'Certified Providers Details';
        $page_description = 'Some description for the page';
        return view('admin.applicators.show', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertifiedApplicator $certifiedApplicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertifiedApplicator $certifiedApplicator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertifiedApplicator $certifiedApplicator)
    {
        //
    }
}
