<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CertifiedProvider;
use App\Models\CertifiedApplicator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        try {                 
            if($request->certifiedProviderId){
              
               $request->validate([
                    'providerAdministrator' => 'nullable|string',
                    'providerName' => 'required|string',
                    'providerPhone' => 'required|integer',
                    'providerEmail' => 'required|email|unique:certified_providers,provider_email,' . $request->certifiedProviderId . ',provider_id',
                ]);
                $provider =CertifiedProvider::find($request->certifiedProviderId);

                $message='Certified provider updated sucessfully!';
               
            }else{               
                $request->validate([
                    'providerAdministrator' => 'nullable|string',
                    'providerName' => 'required|string',
                    'providerPhone' => 'required|integer',
                    'providerEmail' => 'required|email|unique:certified_providers,provider_email',
                    'providerPassword' => 'required|string|min:8',
                    'providerLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'providerImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $provider = new CertifiedProvider();

                $message='Certified provider added sucessfully!';
            }                   

          
            $provider->provider_administrator = $request->providerAdministrator;
            $provider->provider_name = $request->providerName;
            $provider->provider_email = $request->providerEmail;
            $provider->provider_password = Hash::make($request->providerPassword);
            $provider->provider_phone = $request->providerPhone;

            if($request->has('providerLogo')){
                $providerLogoPath = $request->file('providerLogo')->store('public/provider_logos');
                $path=str_replace('public/','', $providerLogoPath);   
                $provider->provider_logo_image = $path;        
            }

            if($request->has('providerLogo')){
                $providerProfileImagePath = $request->file('providerImage')->store('public/provider_profile_images');
                $path2=str_replace('public/','', $providerProfileImagePath); 
                $provider->provider_profile_image = $path2;
            }            
           
            $provider->save();

            return response()->json(['status'=>true,'message' => $message],200);

        } catch (ValidationException $e) {
            // $errors = $e->validator->errors()->all();

            return response()->json([
                'status' => false,
                'errors' =>  $e->validator->errors()->toArray(),
            ], 422); 

        } catch (\Exception $e) {
            // Other errors occurred
            \Log::error($e->getMessage() . ' in ' . $e->getFile() . ' Line No. ' . $e->getLine());
            return response()->json(['status' => false, 'message' => 'An error occurred while adding or updating the certified provider!'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$certifiedProviderId)
    {
      
       $CertifiedProvider=CertifiedProvider::find($certifiedProviderId);   
        
            $page_title = 'Certified Providers Details';
            $page_description = 'Some description for the page';
            if ($request->ajax()) {
                $provider_id = $request->get('provider_id');
                if ($CertifiedProvider) {
                    $data = CertifiedApplicator::query();
                    $data->where('applicator_provider_id', $provider_id);                
                    $data->withCount('registeredCodes', 'warrantyClaims');
                
                return DataTables::of($data)
                    ->orderColumn('applicator_name', function ($query, $order) {
                        $query->orderBy('applicator_name', $order); // Corrected the syntax here
                    })
                    ->filterColumn('applicator_name', function ($query, $keyword) {
                        $query->where('applicator_name', 'like', "%{$keyword}%");
                    })
                    ->toJson();            
                
                }else{
                    return DataTables::of([])
                                ->toJson();
                }
            }
            return view('admin.certified-providers.show', compact('page_title', 'page_description','CertifiedProvider'));
    
   }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $CertifiedProvider=CertifiedProvider::find($id);

        return response()->json(['status'=>true,'data' => $CertifiedProvider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$certifiedProviderId)
    {
        $request->validate([
            'status' => 'required|in:active,revoked',
        ]);

        $CertifiedProvider=CertifiedProvider::findOrFail($certifiedProviderId);
        $CertifiedProvider->provider_status = $request->status == 'active' ? '1' : '0';
        $CertifiedProvider->save();

        session()->flash('success', 'Status updated successfully');
        // Return a response
        return response()->json(['message' => 'Status updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CertifiedProvider $certifiedProvider)
    {
        //
    }

    
}
