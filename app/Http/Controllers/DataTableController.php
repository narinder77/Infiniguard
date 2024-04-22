<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertifiedProvider;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Certified Providers';
        $page_description = 'Some description for the page';

        if ($request->ajax()) {
            $draw                 =         $request->get('draw');
            $start                 =         $request->get("start");
            $rowPerPage         =         $request->get("length");
            $orderArray        =         $request->get('order');
            $columnNameArray     =         $request->get('columns');
            $searchArray         =         $request->get('search');
            $columnIndex         =         $orderArray[0]['column'];
            $columnName         =         $columnNameArray[$columnIndex]['data'];
            $columnSortOrder     =         $orderArray[0]['dir'];
            $searchValue         = $searchArray['value'];

            $query = CertifiedProvider::query();

            $total = $query->count();
        
            if (!empty($searchValue)) {
                $query->where(function($query) use ($searchValue) {
                    $query->where('provider_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('provider_administrator', 'like', '%' . $searchValue . '%')
                        ->orWhere('provider_email', 'like', '%' . $searchValue . '%')
                        ->orWhere('provider_phone', 'like', '%' . $searchValue . '%');
                });
            }
        
            $totalFilter = $query->count();
        
            $data = $query->skip($start)
                ->take($rowPerPage)
                ->orderBy($columnName, $columnSortOrder)
                ->get();
        
            $response = [
                "draw" => intval($draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $totalFilter,
                "data" => $data,
            ];
    
            return $response;
        }
        return view('provider.index', compact('page_title', 'page_description'));
    }
}
