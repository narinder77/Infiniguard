<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            return DataTables::of($data)
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
        try {
            $validator = Validator::make($request->all(), [
                'client_company_name' => 'required|string|max:255',
                'client_firstname' => 'required|string|max:255',
                'client_lastname' => 'required|string|max:255',
                'client_email' => 'required|email|unique:clients|max:255',
                'client_phone' => 'required|string|max:20',
                'client_provider_id' => 'required|string|min:1',
                'client_password' => 'required|string|min:8', // Enforce minimum password length
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()->toArray(),
                ], 422);
            }
            $request->merge([
                'client_password' => Hash::make($request->client_password)
            ]);

            $client = Client::create($request->all());

            return response()->json([
                'message' => 'Client created successfully',
                'code' => 201
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'errors' => [], // Empty errors for non-validation exceptions
                'code' => 500
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
