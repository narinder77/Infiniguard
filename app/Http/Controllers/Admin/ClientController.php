<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ClientEquipment;
use App\Models\GeneratedQrCode;
use App\Rules\UniqueEmailInJson;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedProvider;
use App\Models\EquipmentInspection;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Clients';
        $page_description = 'Some description for the page';

        if ($request->ajax()) {
            $data = Client::with('certifiedProviders');
            
            return DataTables::of($data)                   
                ->orderColumn('provider_name', function ($query, $order) {
                    $query->join('certified_providers', 'clients.client_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                })
                ->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })
                ->toJson();
        }
        $providers = CertifiedProvider::select('provider_id', 'provider_name')->get();
        return view('admin.clients.index', compact('page_title', 'page_description', 'providers'));
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
    public function store(StoreClientRequest $request)
    {
        try {
            $client = Client::create($request->validated());

            return response()->json([
                'message' => 'Client created successfully',
                'code' => 201
            ]);
        } catch (\Exception $exception) {
            Log::error('Error creating record:', [
                'exception' => $exception->getMessage(),
                'Line No' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
            return response()->json([
                'message' => 'An error occurred during creation.',
                'errors' => $exception->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        if ($client) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $client
            ]);
        } else {
            return response()->json([
                'message' => "Client not found",
                "code"    => 404
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $client->update($request->validated());

            return response()->json([
                'message' => 'Client Profile Updated successfully',
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            Log::error('Error updating client profile:', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'code' => $exception->getCode()
            ], 500);            
            return response()->json([
                'message' => 'An error occurred while updating the client profile.',
                'errors' => $exception->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function clientInfo($id)
    {
        $clientEquipment = ClientEquipment::where('equipment_qr_id', $id)->first();
        $client_additional_info = '';
        if (!empty($clientEquipment) && !empty($clientEquipment->client_additional_info)) {
            $client_additional_info = json_decode($clientEquipment->client_additional_info);
        }
        $Reminder_days = 90;
        $result = $clientEquipment ?? EquipmentInspection::where('inspection_equipment_qr_id', $id)->first();
        
        if (!empty($result)) {
            $inspection_created_date = strtotime($result->created_at);
            $days_since_inspection = ceil((time() - $inspection_created_date) / (60 * 60 * 24));
            $days_until_next_reminder = $Reminder_days - ($days_since_inspection % $Reminder_days);
            $next_reminder_date = ($days_since_inspection <= $Reminder_days) ? date('Y-m-d', strtotime("+ $days_until_next_reminder days")) : 'No upcoming maintenance reminder.';
        } else {
            $next_reminder_date = 'No upcoming maintenance reminder.';
        }
        
        return response()->json([
            'status' => true,
            "clientEquipmentData" => $clientEquipment,
            "clientAdditionalInfo" => $client_additional_info,
            "nextReminderDate" => $next_reminder_date
        ], 200);        
                
    }

    public function storeClientEquipment(Request $request)
    {
       

        $request->validate([
            'client_id' => ['required'],
            'maintenanceReminder' => 'required|in:0,1',
            'reminderDays' => 'required|min:1|max:90',
            'nextReminderDate' => 'required',
            'reminderLang' => 'required|in:1,2',
            'contact_email.*' => 'required|email|unique:client_equipments,client_additional_info->"$[*].Email"',
            'contact_name.*' => 'required|string|max:255',
        ]); 

   
        try { 
            if($request->additionalInfo && $request->contact_email){
                $additionalInfo=array();
                for($i=0; $i<count($request->contact_email); $i++){
                    $data["ContactName"]=$request->contact_name[$i]; 
                    $data["Email"]=$request->contact_email[$i]; 
                    $data["Added_from"]="Admin"; 
                    $additionalInfo[]=$data;
                }
                $clientEquipment['client_additional_info']=json_encode($additionalInfo);
            }
           
            $id['equipment_qr_id']=$request->qr_id;
                
        
            $clientEquipment['equipment_qr_id']=$request->qr_id;
            $clientEquipment['client_id']=$request->client_id;
            $clientEquipment['client_maintenance_reminder']=$request->maintenanceReminder;
            $clientEquipment['client_reminder_days']=$request->reminderDays;
            $clientEquipment['client_reminder_language']=$request->reminderLang;

            $client=ClientEquipment::updateOrCreate($id,$clientEquipment);

            return response()->json([
                'status' => true,
                'message' => 'Client Equipment updated successfully',
                'code' => 201
            ]);
        } catch (\Exception $exception) {
            Log::error('Error creating record:', [
                'exception' => $exception->getMessage(),
                'Line No' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
            return response()->json([
                'message' => 'An error occurred during creation.',
                'errors' => $exception->getMessage(),
            ], 500);
        }

    }
}
