<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\EquipmentInspection;
use App\Http\Controllers\Controller;
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
        $page_title = 'warranty inspected records';
        $page_description = 'Some description for the page';
        if ($request->ajax()) {
            $query = EquipmentInspection::query();
            $query->where('inspection_equipment_qr_id', $id);
            $query->orderBy('inspection_id', 'asc');
            $data = $query->get();
            return DataTables::of($data)
                ->addColumn('date', function ($row) {
                    $createdAt = $row->created_at;
                    if (empty($createdAt) || !strtotime($createdAt)) {
                        return 'd-m-Y';
                    } else {
                        return date('m-d-Y', strtotime($row->created_at));
                    }
                })
                ->addColumn('time', function ($row) {
                    $createdAt = $row->created_at;
                    if (empty($createdAt) || !strtotime($createdAt)) {
                        return '00:00:00';
                    } else {
                        return date('H:i:s', strtotime($row->created_at));
                    }
                })
                ->addColumn('activity', function ($row) {
                    $createdAt = $row->created_at;
                    if (empty($createdAt) || !strtotime($createdAt)) {
                        return '00:00:00';
                    } else {
                        return date('H:i:s', strtotime($row->created_at));
                    }
                })
                ->toJson();
        }
        return view('admin.inspection-history.show', compact('page_title', 'page_description'));
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
}
