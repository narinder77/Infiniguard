<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneratedQrCode;
use App\Models\RegisteredQrCode;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class RegisteredQrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Registered Equipment';
        $page_description = 'Some description for the page';

        if ($request->ajax()) {
            $query = RegisteredQrCode::query();
            $query->with('certifiedApplicators', 'certifiedProviders', 'registeredEquipments');

            return DataTables::of($query)
                ->orderColumn('provider_name', function ($query, $order) {
                    $query->join('certified_applicators', 'registered_qr_codes.applicator_id', '=', 'certified_applicators.applicator_id')
                        ->join('certified_providers', 'certified_applicators.applicator_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                })
                ->orderColumn('applicator_certification_id', function ($query, $order) {
                    $query->join('certified_applicators', 'registered_qr_codes.applicator_id', '=', 'certified_applicators.applicator_id')
                        ->orderBy('certified_applicators.applicator_certification_id', $order);
                })
                ->orderColumn('equipment_serial_number', function ($query, $order) {
                    $query->join('generated_qr_codes', 'registered_qr_codes.equipment_qr_id', '=', 'generated_qr_codes.equipment_qr_id')
                        ->orderBy('generated_qr_codes.equipment_serial_number', $order);
                })
                ->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })
                ->filterColumn('applicator_certification_id', function ($query, $keyword) {
                    $query->whereHas('certifiedApplicators', function ($query) use ($keyword) {
                        $query->where('applicator_certification_id', 'like', "%{$keyword}%");
                    });
                })
                ->filterColumn('equipment_serial_number', function ($query, $keyword) {
                    $query->whereHas('registeredEquipments', function ($query) use ($keyword) {
                        $query->where('equipment_serial_number', 'like', "%{$keyword}%");
                    });
                })
                ->toJson();
        }
        /*      
        if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search')['value'];

            $query = RegisteredQrCode::query();
            $query->with('certifiedApplicators', 'certifiedProviders', 'registeredEquipments');

            if (!empty($search)) {
                $query->where(function ($query) use ($search )  {
                    $query->where('equipment_qr_id', 'LIKE', "%$search%")
                        ->orWhereHas('certifiedApplicators', function ($query) use ($search) {
                            $query->where('applicator_certification_id', 'LIKE', "%$search%");
                        })->orWhereHas('certifiedProviders', function ($query) use ($search) {
                            $query->where('provider_name', 'LIKE', "%$search%");
                        });
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
        }*/
        return view('admin.registered-qr-codes.index', compact('page_title', 'page_description'));
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
    public function show(Request $request,$certifiedApplicatorId)
    {
        $registeredQrCode=RegisteredQrCode::where('applicator_id',$certifiedApplicatorId)->get();
    //    dd($registeredQrCode);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegisteredQrCode $registeredQrCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $registeredEquipmentId)
    {
        $request->validate([
            'serial_number' => 'required|confirmed',
       ]);  
       try {  
            $query = GeneratedQrCode::find($registeredEquipmentId);
            $query->equipment_serial_number=$request->serial_number;
            $query->equipment_model_number=$request->serial_number;
            $query->save();

            return response()->json(['status'=>true,'message' => 'Serial Number updated sucessfully!'],200);

        } catch (\Exception $e) {
            // Other errors occurred
            \Log::error($e->getMessage() . ' in ' . $e->getFile() . ' Line No. ' . $e->getLine());
            return response()->json(['status' => false, 'message' => 'An error occurred while updating the Serial Number!'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisteredQrCode $registeredQrCode)
    {
        //
    }
}
