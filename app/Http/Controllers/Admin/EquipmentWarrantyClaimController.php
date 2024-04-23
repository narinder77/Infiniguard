<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EquipmentWarrantyClaim;
use Illuminate\Http\Request;

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
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search')['value'];

            $query = EquipmentWarrantyClaim::query();
            $query->join('generated_qr_codes', 'equipment_warranty_claims.equipment_claim_qr_id', '=', 'generated_qr_codes.equipment_qr_id')
            ->join('registered_qr_codes', 'generated_qr_codes.equipment_qr_id', '=', 'registered_qr_codes.equipment_qr_id')
            ->join('certified_applicators', 'registered_qr_codes.applicator_id', '=', 'certified_applicators.applicator_id')
            ->join('certified_providers', 'certified_applicators.applicator_provider_id', '=', 'certified_providers.provider_id')
            ->select('equipment_warranty_claims.*', 'certified_providers.provider_name','certified_applicators.applicator_certification_id');
        
      
            //$query->with('certifiedApplicators', 'certifiedProviders', 'registeredEquipments');

            if (!empty($search)) {
                $query->when($search, function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('equipment_claim_name', 'like', "%$search%")
                            ->orWhere('equipment_claim_email', 'like', "%$search%")
                            ->orWhere('equipment_claim_phone_number', 'like', "%$search%")
                            ->orWhere('equipment_claim_qr_id', 'like', "%$search%")
                            ->orWhere('equipment_claim_date', 'like', "%$search%");
                    });
                    /*->orWhereHas('certifiedProviders', function ($q) use ($search) {
                        $q->where('provider_name', 'like', "%$search%");
                    });*/
                });
            }
            if (!empty($order)) {
                $columnIndex = $order[0]['column'];
                $columnName = $columns[$columnIndex]['data']; // Get the actual column name
                $columnSortOrder = $order[0]['dir'];

                if (strpos($columnName, '.') !== false) {
                    $relationship = explode('.', $columnName)[0];
                    $relationshipName = str_replace('_', '', ucwords($relationship, '_'));
                    $relatedColumnName = explode('.', $columnName)[1];
                    $query->with([$relationshipName => function ($query) use ($relatedColumnName, $columnSortOrder) {
                        $query->orderBy($relatedColumnName, $columnSortOrder);
                    }]);
                } else {
                    $query->orderBy($columnName, $columnSortOrder);
                }
            }


            $total = $query->count();
            $filteredTotal = $query->count();
            $query->skip($start)->take($length);
            $data = $query->get();

            $response = [
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $filteredTotal,
                "data" => $data,
            ];
            return $response;
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
    public function edit(EquipmentWarrantyClaim $equipmentWarrantyClaim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EquipmentWarrantyClaim $equipmentWarrantyClaim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentWarrantyClaim $equipmentWarrantyClaim)
    {
        //
    }
}
