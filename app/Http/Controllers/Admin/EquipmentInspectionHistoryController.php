<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneratedQrCode;
use Yajra\DataTables\DataTables;
use App\Models\EquipmentInspection;
use App\Http\Controllers\Controller;
use App\Models\EquipmentWarrantyClaim;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class EquipmentInspectionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

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
    public function show(Request $request, $id)
    {
        $page_title = 'warranty inspected records';
        $page_description = 'Some description for the page';
        if ($request->ajax()) {
            $query = GeneratedQrCode::query();
            $query->where('equipment_qr_id', $id);
            $query->with('registeredCodes','equipmentInspection');
            $query->orderBy('equipment_qr_id', 'asc');         
            $data = $query->first();

            $formattedData = [];
                foreach ($data->registeredCodes as $registered) {  
                 
                    $formattedData[]= [
                        'inspection_id' => $registered->id,
                        'date' => $registered->createdAt(),
                        'time' => $registered->time(),
                        'activity' => 'Registration', // Assuming this is hardcoded for now
                        'inspection_address' => $registered->address,
                        'notes_link' => '<a class="btn btn-primary rounded btn-sm add-reg-notes" href="" title="Add Registration Notes">Registration Notes</a>',
                        'inspection_link' => '<a class="btn btn-primary rounded btn-sm add-reg-notes" href="" title="Add Registration Notes">View inspection pictures</a>',
                    ];
                }                
                foreach ($data->equipmentInspection as $inspection) {   

                    $warranty=EquipmentWarrantyClaim::where('equipment_claim_inspection_id',$inspection->inspection_id)->first();
                    if(isset($warranty->equipment_claim_status) && $warranty->equipment_claim_status == "1"){
                        $notes=$warranty->equipment_claim_status == "1" ? 'Yes/answered' : 'Yes/unanswered';
                    }else{
                        $notes='No';
                    }
                                 
                    $formattedData[]= [
                        'inspection_id' => $inspection->inspection_id,
                        'date' => $inspection->createdAt(),
                        'time' => $inspection->time(),
                        'activity' => 'Maintenance', // Assuming this is hardcoded for now
                        'inspection_address' => $inspection->inspection_address,
                        'notes_link' => '<a class="btn btn-primary rounded btn-sm add-reg-notes" href="" title="Add Registration Notes">'.$notes.'</a>',
                        'inspection_link' => '<a class="btn btn-primary rounded btn-sm add-reg-notes" href="" title="Add Registration Notes">View inspection pictures</a>',
                    ];
                }
                
                return response()->json(['data' => $formattedData]);
            // return DataTables::of($formattedData)
            //     ->addColumn('date', function ($row) {
            //         return 'Maintenance';
            //         //return $row->createdAt;      
            //     })
            //     ->addColumn('time', function ($row) {   
            //         return 'Maintenance';               
            //        // return $row->time;
                    
            //     })
            //     ->addColumn('activity', function ($row) {
            //        return 'Maintenance';
                   
            //     })
            //     ->toJson();
        }
        return view('admin.inspection-history.show', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipmentInspection $equipmentInspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EquipmentInspection $equipmentInspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentInspection $equipmentInspection)
    {
        //
    }
}
