<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneratedQrCode;
use Yajra\DataTables\DataTables;
use App\Models\EquipmentInspection;
use App\Http\Controllers\Controller;
use App\Models\EquipmentWarrantyClaim;

class EquipmentWarrantyClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Warranty Claims';
        $page_description = 'Some description for the page';
    
        if ($request->ajax()) {
            $query = EquipmentWarrantyClaim::query();
            $query->with('certifiedApplicators.certifiedProviders');
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
                ->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedApplicators.certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })
                ->filterColumn('applicator_certification_id', function ($query, $keyword) {
                    $query->whereHas('certifiedApplicators', function ($query) use ($keyword) {
                        $query->where('applicator_certification_id', 'like', "%{$keyword}%");
                    });
                })
                ->toJson();
        }
     
		return view('admin.equipment-warranty-claims.index', compact('page_title', 'page_description'));
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

    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentWarrantyClaim $equipmentWarrantyClaim)
    {
        dd($equipmentWarrantyClaim);
        print_r($equipmentWarrantyClaim->toArray());
        return 'show warranty claims';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $equipmentWarrantyClaim = EquipmentWarrantyClaim::where('equipment_claim_inspection_id', $id)->first();

        if ($equipmentWarrantyClaim) {
            $equipmentInspectionId = $equipmentWarrantyClaim->equipment_claim_inspection_id;
        } else {
            $equipmentInspectionId = $id;
        }

        $equipmentInspection = EquipmentInspection::where('inspection_id', $equipmentInspectionId)
            ->select('inspection_equipment_qr_id', 'inspection_id', 'inspection_notes', 'created_at')
            ->first();

        $generatedQrCode = GeneratedQrCode::where('equipment_qr_id', $equipmentInspection->inspection_equipment_qr_id)
            ->first();

        $title = "INFINIGUARD® Notes For QR" . $generatedQrCode->equipment_qr_number . " : " . $equipmentInspection->createdAt() . ' ' . $equipmentInspection->time();

        return response()->json(['status' => true, 'type' => $equipmentWarrantyClaim ? "warranty" : "inspection", 'data' => $equipmentWarrantyClaim ?: $equipmentInspection, 'title' => $title]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            if($request->type == 'warranty'){
                $request->validate([
                    'equipment_claim_status'=> 'required|in:0,1',
                    'equipment_claim_notes'=> 'required|string:max:255'
                ]);
                $equipmentWarrantyClaim =EquipmentWarrantyClaim::find($id);
                $equipmentWarrantyClaim['equipment_claim_status']=$request->equipment_claim_status;
                $equipmentWarrantyClaim['equipment_claim_notes']=$request->equipment_claim_notes;                
                $equipmentWarrantyClaim->save();
            }else{
                $request->validate([
                    'equipment_claim_notes'=> 'required'
                ]);

                $equipmentInspection = EquipmentInspection::find($id);
                $equipmentInspection['inspection_notes']=$request->equipment_claim_notes;
                $equipmentInspection->save();
            }

            return response()->json(['status' => true, 'message' => 'Record updated successfully']);
        } catch (\Exception $e) {
            // Other errors occurred
            \Log::error($e->getMessage() . ' in ' . $e->getFile() . ' Line No. ' . $e->getLine());
            return response()->json(['status' => false, 'message' => 'An error occurred while updating the status!'], 500);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentWarrantyClaim $equipmentWarrantyClaim)
    {
        //
    }
    public function viewImage($id){
        dd($id);
    }
}
