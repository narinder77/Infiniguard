<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedProvider;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;

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
            $data = Client::with('certifiedProviders');
            $orderDirection = $request->input('order.0.dir', 'asc');

            return DataTables::of($data)
                    ->addColumn('id', function($row) use ($orderDirection) {
                        // Get the current page number and page length
                        $currentPage = request()->input('start', 0) / request()->input('length', 10) + 1;
                        $pageSize = request()->input('length', 10);
                        // Calculate the index based on the current page, page size, and order direction
                        $index = ($currentPage - 1) * $pageSize + ($orderDirection === 'asc' ? $row->id : $data->count() - $row->id + 1);
                        return $index;
                    })
                ->orderColumn('provider_name', function ($query, $order) {
                    $query->join('certified_providers', 'clients.client_provider_id', '=', 'certified_providers.provider_id')
                        ->orderBy('certified_providers.provider_name', $order);
                })
                ->filterColumn('provider_name', function ($query, $keyword) {
                    $query->whereHas('certifiedProviders', function ($query) use ($keyword) {
                        $query->where('provider_name', 'like', "%{$keyword}%");
                    });
                })
                ->toJson();
        }
        $providers = CertifiedProvider::select('provider_id', 'provider_name')->get();
        return view('admin.clients.index', compact('page_title', 'page_description', 'providers'));
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
    public function store(StoreClientRequest $request)
    {
        try {
            $client = Client::create($request->validated());

            return response()->json([
                'message' => 'Client created successfully',
                'code' => 201
            ]);
        } catch (\Exception $exception) {
            Log::error('Error creating record:', [
                'exception' => $exception->getMessage(),
                'Line No' => $exception->getLine(),
                'code' => $exception->getCode()
            ], 500);
            return response()->json([
                'message' => 'An error occurred during creation.',
                'errors' => $exception->getMessage(),
            ], 500);
        }
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
        if ($client) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $client
            ]);
        } else {
            return response()->json([
                'message' => "Client not found",
                "code"    => 404
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $client->update($request->validated());

            return response()->json([
                'message' => 'Client Profile Updated successfully',
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            Log::error('Error updating client profile:', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'code' => $exception->getCode()
            ], 500);            
            return response()->json([
                'message' => 'An error occurred while updating the client profile.',
                'errors' => $exception->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
