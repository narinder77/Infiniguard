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
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search')['value'];

            $query = CertifiedProvider::query();

            $total = $query->count();

            if (!empty($search)) {
                $query->when($search, function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('provider_id', 'like', "%$search%")
                            ->orWhere('provider_name', 'like', "%$search%")
                            ->orWhere('provider_administrator', 'like', "%$search%")
                            ->orWhere('provider_email', 'like', "%$search%")
                            ->orWhere('provider_phone', 'like', "%$search%");
                    });
                });
            }
            if (!empty($order)) {
                $columnIndex = $order[0]['column'];
                 $columnName = $columns[$columnIndex]['data'];
             
                $columnSortOrder = $order[0]['dir'];
                $query->orderBy($columnName, $columnSortOrder);
            }
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
        
        return view('admin.dashboard', compact('page_title', 'page_description', 'counts'));
    }
}
