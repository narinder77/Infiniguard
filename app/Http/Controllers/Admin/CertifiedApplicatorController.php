<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedApplicator;
use App\Http\Controllers\Controller;

class CertifiedApplicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Certified Applicators';
        $page_description = 'Some description for the page';

        /*if ($request->ajax()) {
            $data = CertifiedApplicator::with(['certifiedProviders'])
                ->withCount('registeredCodes', 'warrantyClaims');

            return DataTables::of($data)
                ->orderColumn('provider_name', function ($query, $order) {
                    $query->with(['certifiedProviders' => function ($query) use ($order) {
                        $query->orderBy('certified_providers.provider_name', $order);
                    }]);  
                })                  
                ->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })
                ->toJson();
        }*/
        if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search')['value'];

            $query = CertifiedApplicator::query();
            $query->with('certifiedProviders')->withCount('registeredCodes', 'warrantyClaims');

            if (!empty($search)) {
                $query->when($search, function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('applicator_id', 'like', "%$search%")
                            ->orWhere('applicator_certification_id', 'like', "%$search%")
                            ->orWhere('applicator_name', 'like', "%$search%")
                            ->orWhere('applicator_email', 'like', "%$search%")
                            ->orWhere('applicator_date', 'like', "%$search%");
                    })->orWhereHas('certifiedProviders', function ($q) use ($search) {
                        $q->where('provider_name', 'like', "%$search%");
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
            // Pagination
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
        return view('admin.certified-applicators.index', compact('page_title', 'page_description'));
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
    public function show(CertifiedApplicator $certifiedApplicator)
    {
        $page_title = 'Certified Providers Details';
        $page_description = 'Some description for the page';
        return view('admin.applicators.show', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertifiedApplicator $certifiedApplicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertifiedApplicator $certifiedApplicator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertifiedApplicator $certifiedApplicator)
    {
        //
    }
}
