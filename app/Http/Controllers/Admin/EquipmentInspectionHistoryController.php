<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\GeneratedQrCode;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedApplicator;
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
        if ($request->ajax()) {
            $draw = $request->get('draw');

            $data = GeneratedQrCode::with(['registeredCodes', 'equipmentInspection' => function ($query) {
                $query->with(['warrantyClaims' => function ($query) {
                    $query->select('equipment_claim_inspection_id', 'equipment_claim_status');
                }]);
            }])->where('equipment_qr_id', $id)->first();
    
            $formattedData = [];
    
            foreach ($data->registeredCodes as $registered) {
                $formattedData[] = $this->formatData($registered, 'Registration');
            }
    
            foreach ($data->equipmentInspection as $inspection) 
            {
                if(isset($inspection->warrantyClaims[0])){
                    $className = $inspection->warrantyClaims[0]->equipment_claim_status == "1" ? ' btn-success' : 'btn-warning';
                    $notes = $inspection->warrantyClaims[0]->equipment_claim_status == "1" ? 'Yes/answered' : 'Yes/unanswered';
                }else{
                    $className = 'btn-secondary';

                    $notes ='No';
                }
               
                $formattedData[] = $this->formatData($inspection, 'Maintenance', $notes,$className);
            }
    
            $total = count($formattedData);
            $filteredTotal =  $total;
            $response = [
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $filteredTotal,
                "data" => $formattedData,
            ];
            return $response;
        }
    
        $qr_number = GeneratedQrCode::with('registeredCodes')->where('equipment_qr_id', $id)->first();
        $equip_data=array();
        if($qr_number->registeredCodes[0]->condenser=="1"){
            $equip_data[]='condenser coils';
        }
        if($qr_number->registeredCodes[0]->cabinet=="1"){
            $equip_data[]='cabinet';
        }
        //if($qr_number->registeredCodes[0]->evaporator!="0"){
        //    $equip_data[]='evaporator coils '.$qr_number->registeredCodes[0]->evaporator;
       // }
       
        $equip_data = implode(' and ', $equip_data);
        $title="INFINIGUARD®  Record for QR " .$qr_number->equipment_qr_number. " , " .$equip_data. " protected with INFINIGUARD®";
        $clients = Client::join('certified_providers','certified_providers.provider_id','=','clients.client_provider_id')
                            ->select('clients.client_id', 'clients.client_company_name', 'clients.client_firstname', 'clients.client_lastname','certified_providers.provider_name')->get();
        $page_title = 'warranty inspected records';
        $page_description = 'Some description for the page';
    
        return view('admin.inspection-history.show', compact('page_title', 'page_description', 'clients','qr_number','title'));
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
    private function formatData($data, $activity, $notes = null,$className=null)
    {
        return [
            'inspection_id' => $data->id,
            'date' => $data->createdAt(),
            'time' => $data->time(),
            'activity' => $activity,
            'inspection_address' => $activity == 'Registration' ? $data->address : $data->inspection_address,
            'notes_link' => '<a class="btn '.($className ? $className : 'btn-dark').' rounded add-notes" href="javascript:void(0)" data-id="'.($activity == 'Registration' ? $data->id : $data->inspection_id).'" data-type="'.($activity == 'Registration' ? "registration": "warranty").'"  data-bs-toggle="modal" data-bs-target="#update-notes">' . ($activity == 'Registration' ? 'Registration Notes' : $notes) . '</a>',
            'inspection_link' => '<a class="btn btn-primary rounded btn-sm add-reg-notes" href="' .($activity == 'Registration' ? route('admin.register-equp.viewImage',$data->id) :  route('admin.inpspection.viewImage',$data->inspection_id)) . '">View inspection pictures</a>',
        ];
    }
    public function downloadPdf($id){
       
        $data = GeneratedQrCode::with(['registeredCodes', 'equipmentInspection' => function ($query) {
            $query->with(['warrantyClaims' => function ($query) {
                $query->select('equipment_claim_inspection_id', 'equipment_claim_status');
            }]);
        }])->where('equipment_qr_id', $id)->first(); 
        $applicator=CertifiedApplicator::where('applicator_id',$data->registeredCodes[0]->applicator_id)->select('applicator_certification_id')->first();       
        $qr_number=$data->equipment_qr_number;
        $certification_id=$applicator->applicator_certification_id;
        $image1=asset('storage/'.$data->registeredCodes[0]->model_number_image);
        $image2=asset('storage/'.$data->registeredCodes[0]->serial_number_image);

        $formattedData = [];
    
            foreach ($data->registeredCodes as $registered) {
                $formattedData[] = $this->pdfData($registered, 'Registration');
            }
    
            foreach ($data->equipmentInspection as $inspection) 
            {
                if(isset($inspection->warrantyClaims[0])){
                    $warrantyClaim = $inspection->warrantyClaims[0]->equipment_claim_status == "1" ? 'Yes/answered' : 'Yes/unanswered';
                }else{
                    $warrantyClaim ='No';
                }
               
                $formattedData[] = $this->pdfData($inspection, 'Maintenance', $warrantyClaim);
            }
            $pdf = PDF::loadView('admin.pdf',compact('formattedData','qr_number','certification_id'));
        return $pdf->download('admin.pdf');
    }
    private function pdfData($data, $activity, $warrantyClaim = null){
        return [
            'type'=>$activity == 'Registration'? 'Registration' : 'Inspection',
            'date' => $data->createdAt(),
            'time' => $data->time(),
            'inspection_address' => $activity == 'Registration' ? $data->address : $data->inspection_address,
            'notes' => $activity == 'Registration' ? $data->notes : $data->inspection_notes,
            'warrantyClaim' =>$warrantyClaim,
        ]; 
    }
}
