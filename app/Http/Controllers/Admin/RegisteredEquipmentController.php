<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RegisteredQrCode;
use App\Http\Controllers\Controller;

class RegisteredEquipmentController extends Controller
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
            $query->with('certifiedProviders')->withCount('CompletedApplications', 'warrantyClaims');

            $total = $query->count();

            if (!empty($searchValue)) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('applicator_id', 'LIKE', "%$searchValue%")
                        ->orWhere('applicator_certification_id', 'LIKE', "%$searchValue%")
                        ->orWhere('applicator_name', 'LIKE', "%$searchValue%")
                        ->orWhere('applicator_email', 'LIKE', "%$searchValue%")
                        ->orWhereHas('certifiedProviders', function ($query) use ($searchValue) {
                            $query->where('provider_name', 'LIKE', "%$searchValue%");
                        });
                });
            }
            if (!empty($order)) {
                $columnIndex = $order[0]['column'];
                $columnName = $columns[$columnIndex]['data'];
                $columnSortOrder = (isset($order[0]['dir']) && $order[0]['dir'] === 'desc') ? 'desc' : 'asc';
                if (strpos($columnName, '.') !== false) {
                    [$relationship, $relatedColumnName] = explode('.', $columnName);
                    $query->join($relationship, function ($join) use ($relatedColumnName, $columnSortOrder) {
                        $join->orderBy($relatedColumnName, $columnSortOrder);
                    });
                } else {
                    $query->orderBy($columnName, $columnSortOrder);
                }
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

        /*if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowPerPage = $request->get("length");
            $orderArray = $request->get('order');
            $columnNameArray = $request->get('columns');
            $searchArray = $request->get('search');

            $columnIndex = $orderArray[0]['column'] ?? null;
            $columnName = isset($columnNameArray[$columnIndex]['data']) ? $columnNameArray[$columnIndex]['data'] : 'applicator_certification_id';
            $columnSortOrder = $orderArray[0]['dir'] ?? 'asc';
            $searchValue = $searchArray['value'] ?? null;

            $query = RegisteredQrCode::query();
            $query->with('certifiedProviders')->withCount('CompletedApplications', 'warrantyClaims');

            $total = $query->count();

            if (!empty($searchValue)) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('applicator_id', 'LIKE', "%$searchValue%")
                        ->orWhere('applicator_certification_id', 'LIKE', "%$searchValue%")
                        ->orWhere('applicator_name', 'LIKE', "%$searchValue%")
                        ->orWhere('applicator_email', 'LIKE', "%$searchValue%")
                        ->orWhereHas('certifiedProviders', function ($query) use ($searchValue) {
                            $query->where('provider_name', 'LIKE', "%$searchValue%");
                        });
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
        }   */     
        return view('admin.registered-equipments.index', compact('page_title', 'page_description'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'create route';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'store route';
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return 'show route RegisteredEquipment';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return 'edit route';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, )
    {
        return 'update route';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        return 'destroy route';
    }
}
