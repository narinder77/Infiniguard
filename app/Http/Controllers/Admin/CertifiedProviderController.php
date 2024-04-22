<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CertifiedProvider;
use App\Http\Controllers\Controller;

class CertifiedProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page_title = 'Certified Providers';
        $page_description = 'Some description for the page';

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
        return view('admin.certified-providers.index', compact('page_title', 'page_description'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    public function show($certifiedProviderId)
    {
       $CertifiedProvider=CertifiedProvider::find($certifiedProviderId);

            $page_title = 'Certified Providers Details';
            $page_description = 'Some description for the page';
    
            return view('admin.certified-providers.show', compact('page_title', 'page_description','CertifiedProvider'));
    
   }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CertifiedProvider $certifiedProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertifiedProvider $certifiedProvider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertifiedProvider $certifiedProvider)
    {
        //
    }
}
