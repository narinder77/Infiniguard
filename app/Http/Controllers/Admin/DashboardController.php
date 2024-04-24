<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\RegisteredQrCode;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedProvider;
use App\Models\CertifiedApplicator;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request){
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        
        $counts = [
            'certified_providers' => CertifiedProvider::count(),
            'certified_applicators' => CertifiedApplicator::count(),
            'registered_qr_codes' => RegisteredQrCode::count(),
        ];

        if ($request->ajax()) {
            $query = RegisteredQrCode::query();
            $query->with('certifiedApplicators', 'certifiedProviders');

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
               /* ->orderColumn('equipment_serial_number', function ($query, $order) {
                    $query->join('generated_qr_codes', 'registered_qr_codes.equipment_qr_id', '=', 'generated_qr_codes.equipment_qr_id')
                        ->orderBy('generated_qr_codes.equipment_serial_number', $order);
                })*/
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
                /*->filterColumn('equipment_serial_number', function ($query, $keyword) {
                    $query->whereHas('registeredEquipments', function ($query) use ($keyword) {
                        $query->where('equipment_serial_number', 'like', "%{$keyword}%");
                    });
                })*/
                ->toJson();
        }
        return view('admin.dashboard', compact('page_title', 'page_description', 'counts'));
    }
}
