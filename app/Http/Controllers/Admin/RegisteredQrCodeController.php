<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisteredQrCode;
use App\Models\CertifiedApplicator;
use App\Models\RegisteredEquipment;
use Illuminate\Http\Request;

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
        }
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
    public function show(RegisteredQrCode $registeredQrCode)
    {
        //
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
    public function update(Request $request, RegisteredQrCode $registeredQrCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegisteredQrCode $registeredQrCode)
    {
        //
    }
}
