<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneratedQrCode;
use App\Http\Controllers\Controller;

class GeneratedQrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Generated QR Codes';
        $page_description = 'Some description for the page';

        if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowPerPage = $request->get("length");
            $orderArray = $request->get('order');
            $columnNameArray = $request->get('columns');
            $searchArray = $request->get('search');

            $columnIndex = $orderArray[0]['column'] ?? null;
            $columnName = isset($columnNameArray[$columnIndex]['data']) ? $columnNameArray[$columnIndex]['data'] : 'equipment_qr_id';
            $columnSortOrder = $orderArray[0]['dir'] ?? 'asc';
            $searchValue = $searchArray['value'] ?? null;

            $query = GeneratedQrCode::query();
            $query->with(['registeredCodes']);
            $total = $query->count();

            if (!empty($searchValue)) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('equipment_qr_id', 'LIKE', "%$searchValue%")
                        ->orWhere('equipment_qr_number', 'LIKE', "%$searchValue%")
                        ->orWhere('equipment_model_number', 'LIKE', "%$searchValue%");
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

        return view('admin.generated-qr-codes.index', compact('page_title', 'page_description'));
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
    public function show(GeneratedQrCode $generatedQrCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneratedQrCode $generatedQrCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneratedQrCode $generatedQrCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneratedQrCode $generatedQrCode)
    {
        //
    }
}
