<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {
        $page_title = 'Clients';
        $page_description = 'Some description for the page';
        if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search')['value'];

            $query = Client::query();
            //$query->with('certifiedApplicators', 'certifiedProviders', 'registeredEquipments');

            if (!empty($search)) {
                $query->when($search, function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('client_id', 'like', "%$search%")
                            ->orWhere('client_company_name', 'like', "%$search%")
                            ->orWhere('client_firstname', 'like', "%$search%")
                            ->orWhere('client_email', 'like', "%$search%")
                            ->orWhere('client_phone', 'like', "%$search%");
                    });
                    /*->orWhereHas('certifiedProviders', function ($q) use ($search) {
                        $q->where('provider_name', 'like', "%$search%");
                    });*/
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
		return view('admin.clients.index', compact('page_title', 'page_description'));
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
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
