<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
                    $query->join('certified_providers', 'certified_applicators.applicator_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                })->orderColumn('applicator_certification_id', function ($query, $order) {
                    $query->join('certified_applicators', 'registered_qr_codes.applicator_id', '=', 'certified_applicators.applicator_id')
                        ->orderBy('certified_applicators.applicator_certification_id', $order);
                })->orderColumn('equipment_serial_number', function ($query, $order) {
                    $query->join('generated_qr_codes', 'registered_qr_codes.equipment_qr_id', '=', 'generated_qr_codes.equipment_qr_id')
                        ->orderBy('generated_qr_codes.equipment_serial_number', $order);
                })
                ->toJson();
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
