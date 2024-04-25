<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RegisteredQrCode;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedApplicator;
use App\Http\Controllers\Controller;
use App\Models\EquipmentWarrantyClaim;

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
            $data = CertifiedApplicator::with('certifiedProviders')
                ->withCount('registeredCodes', 'warrantyClaims');
            return DataTables::of($data)
                ->orderColumn('provider_name', function ($query, $order) {
                    $query->join('certified_providers', 'certified_applicators.applicator_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                })
                ->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })
                ->toJson();
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


        return view('admin.certified-applicators.show', compact('page_title', 'page_description', 'certifiedApplicator'));

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
    public function update(Request $request,$certifiedApplicatorId)
    {      
            $request->validate([
                'status' => 'required|in:active,revoked',
            ]);

            $CertifiedApplicator=CertifiedApplicator::findOrFail($certifiedApplicatorId);
            $CertifiedApplicator->applicator_status = $request->status == 'active' ? '1' : '0';
            $CertifiedApplicator->save();

            session()->flash('success', 'Status updated successfully');
            // Return a response
            return response()->json(['message' => 'Status updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertifiedApplicator $certifiedApplicator)
    {
        //
    }

    public function applicatorRegisterEquip(Request $request, $certifiedApplicatorId)
    {
        $certifiedApplicator=CertifiedApplicator::with('certifiedProviders')->where('applicator_id',$certifiedApplicatorId)->first();
        $page_title = 'Applicator Registered Equipment';
        $page_description = 'Some description for the page';

        if ($request->ajax()) {
            if($certifiedApplicator){
                $query = RegisteredQrCode::query();
                $query->where('applicator_id', $certifiedApplicatorId);              
                $query->with('certifiedApplicators', 'certifiedProviders', 'registeredEquipments');
                
                return DataTables::of($query)
                ->orderColumn('equipment_qr_number', function ($query, $order) {
                    $query->orderBy('equipment_qr_id', $order);
                })
                ->orderColumn('created_at', function ($query, $order) {
                    $query->orderBy('created_at', $order);
                })
                ->filterColumn('equipment_qr_number', function ($query, $keyword) {
                    $query->whereHas('registeredEquipments', function ($query) use ($keyword) {
                        $query->where('equipment_qr_number', 'like', "%{$keyword}%");
                    });
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->where('created_at', 'like', "%{$keyword}%");                
                })
                ->toJson();
            }else{
                return DataTables::of([])
                ->toJson();
            }
           
        
        }
        return view('admin.certified-applicators.register-equip', compact('page_title', 'page_description','certifiedApplicator','certifiedApplicatorId'));
    
    }
    public function applicatorWarrantyClaims(Request $request, $certifiedApplicatorId)
    {
     
        $certifiedApplicator=CertifiedApplicator::with('certifiedProviders')->where('applicator_id',$certifiedApplicatorId)->first();
        $page_title = 'Applicator Warranty Claim';
        $page_description = 'Some description for the page';
        if ($request->ajax()) {
            if($certifiedApplicator){
                $query = EquipmentWarrantyClaim::query();               
                $query->whereHas('certifiedApplicators', function($query) use ($certifiedApplicatorId) {
                    $query->where('certified_applicators.applicator_id', $certifiedApplicatorId);
                }); 
                $query->with('certifiedApplicators.certifiedProviders', 'qrCode');
               
                return DataTables::of($query)
                    ->orderColumn('provider_name', function ($query, $order) {
                        $query->join('registered_qr_codes', 'equipment_warranty_claims.equipment_claim_qr_id', '=', 'registered_qr_codes.equipment_qr_id')
                        ->join('certified_applicators', 'registered_qr_codes.applicator_id', '=', 'certified_applicators.applicator_id')
                        ->join('certified_providers', 'certified_applicators.applicator_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                    })                    
                    ->orderColumn('applicator_certification_id', function ($query, $order) {
                        $query->join('registered_qr_codes', 'equipment_warranty_claims.equipment_claim_qr_id', '=', 'registered_qr_codes.equipment_qr_id')
                            ->join('certified_applicators', 'registered_qr_codes.applicator_id', '=', 'certified_applicators.applicator_id')
                            ->orderBy('certified_applicators.applicator_certification_id', $order);
                    })
                    ->orderColumn('equipment_qr_number', function ($query, $order) {
                        $query->orderBy('equipment_claim_qr_id', $order);
                    })
                    ->filterColumn('provider_name', function ($query, $keyword) {
                        $query->whereHas('certifiedApplicators.certifiedProviders', function ($query) use ($keyword) {
                            $query->where('provider_name', 'like', "%{$keyword}%");
                        });
                    })
                    ->filterColumn('equipment_qr_number', function ($query, $keyword) {
                        $query->whereHas('qrCode', function ($query) use ($keyword) {
                            $query->where('equipment_qr_number', 'like', "%{$keyword}%");
                        });
                    })
                    ->filterColumn('applicator_certification_id', function ($query, $keyword) {
                        $query->whereHas('certifiedApplicators', function ($query) use ($keyword) {
                            $query->where('applicator_certification_id', 'like', "%{$keyword}%");
                        });
                    })
                    ->toJson();
            }else{
                return DataTables::of([])
                ->toJson();
            }
           
        
        }
        return view('admin.certified-applicators.warranty-claim', compact('page_title', 'page_description','certifiedApplicator','certifiedApplicatorId'));
    
    
    }
}
