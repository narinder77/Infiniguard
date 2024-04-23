@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Add Order -->
    <div class="modal fade" id="addapplicator">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Certified Applicator</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form> @csrf <div class="form-group">
                            <label class="text-black font-w500">Certification ID <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Company</label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Certification Date <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit table Modal -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit GLOBAL Profile</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form> @csrf <div class="form-group">
                            <label class="text-black font-w500">Certification ID <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Company <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>Adapt Concepts LLC</option>
                                <option value="1">Aruba Climate Control NV</option>
                                <option value="2">Aruba Climate Control NV</option>
                                <option value="3">Aruba Climate Control NV</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Certification Date <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Email -->
    <div class="modal fade" id="reset-email">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Email</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form> @csrf <div class="form-group">
                            <label class="text-black font-w500">Email Address <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Main Content-->
    <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
        <h2 class="mb-0">{{ $CertifiedProvider->provider_name ?? '' }}</h2>
        <div class="d-flex">
         @if($CertifiedProvider)
            <a href="{{ route('admin.profile.edit')}}" class="btn btn-primary rounded mx-2">Edit Profile</a>
            <label class="switch">
                <input type="checkbox" id="togBtn">
                <div class="slider round">
                    <!--ADDED HTML -->
                    <span class="on">Active</span>
                    <span class="off">Revoked</span>
                    <!--END-->
                </div>
            </label>
        @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-outer table-no-space">
            <div class="table-responsive card-table rounded table-hover fs-14">
                <table class="table border-no display mb-4  project-bx">
                    <thead>
                        <tr>
                            <th> Company Logo </th>
                            <th> Company Name </th>
                            <th> Company Administrator </th>
                            <th> Email </th>
                            <th> Phone </th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($CertifiedProvider)
                        <tr>
                            <td>
                             <img src="https://maintenance.infiniguard.com/admin/assets/company_logo/cdb04371-efd1-4380-a504-4b32652089751.jpg"
                                    style="width:100px;height:auto;" alt="">
                                {{-- <img src="{{ asset('storage/'.$CertifiedProvider->provider_logo_image) }}"
                                    style="width:100px;height:auto;" alt=""> --}}
                            </td>
                            <td>{{ $CertifiedProvider->provider_name ?? 'NA' }}</td>
                            <td>{{ $CertifiedProvider->provider_administrator ?? 'NA' }}</td>
                            <td>{{ $CertifiedProvider->provider_email ?? 'NA' }}</td>
                            <td>{{ $CertifiedProvider->provider_phone ?? 'NA' }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
        {{-- <h2 class="mb-0">Certified Applicators for Mexico</h2> --}}
        <h2 class="mb-0">INFINIGUARD® Certified Applicators for Trane Puerto Rico</h2> 
        <div>
            <a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addapplicator">Add
                More</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-outer">
            <div class="table-responsive card-table rounded table-hover fs-14">
                <table class="table border-no display mb-4 dataTablesCard project-bx" id="example5">
                    <thead>
                        <tr>
                            <th> Certification Id </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Certification Date </th>
                            <th> Completed Applications </th>
                            <th> Warranty Claims </th>
                            <th> Certification Status </th>
                            <th> Edit </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> FZ-01 </td>
                            <td> Fernando Zamarripa </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal"
                                    data-bs-target="#reset-email">fernando@infiniguard.com</a>
                            </td>
                            <td> 2019-08-02 </td>
                            <td>
                                <a href="{{ url('register-equipment')}}">266</a>
                            </td>
                            <td>
                                <a href="{{ url('warranty-claims')}}">3</a>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> FZ-01 </td>
                            <td> Fernando Zamarripa </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal"
                                    data-bs-target="#reset-email">fernando@infiniguard.com</a>
                            </td>
                            <td> 2019-08-02 </td>
                            <td>
                                <a href="{{ url('register-equipment')}}">266</a>
                            </td>
                            <td>
                                <a href="{{ url('warranty-claims')}}">3</a>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> FZ-01 </td>
                            <td> Fernando Zamarripa </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal"
                                    data-bs-target="#reset-email">fernando@infiniguard.com</a>
                            </td>
                            <td> 2019-08-02 </td>
                            <td>
                                <a href="{{ url('register-equipment')}}">266</a>
                            </td>
                            <td>
                                <a href="{{ url('warranty-claims')}}">3</a>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> FZ-01 </td>
                            <td> Fernando Zamarripa </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal"
                                    data-bs-target="#reset-email">fernando@infiniguard.com</a>
                            </td>
                            <td> 2019-08-02 </td>
                            <td>
                                <a href="{{ url('register-equipment')}}">266</a>
                            </td>
                            <td>
                                <a href="{{ url('warranty-claims')}}">3</a>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> FZ-01 </td>
                            <td> Fernando Zamarripa </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal"
                                    data-bs-target="#reset-email">fernando@infiniguard.com</a>
                            </td>
                            <td> 2019-08-02 </td>
                            <td>
                                <a href="{{ url('register-equipment')}}">266</a>
                            </td>
                            <td>
                                <a href="{{ url('warranty-claims')}}">3</a>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> FZ-01 </td>
                            <td> Fernando Zamarripa </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal"
                                    data-bs-target="#reset-email">fernando@infiniguard.com</a>
                            </td>
                            <td> 2019-08-02 </td>
                            <td>
                                <a href="{{ url('register-equipment')}}">266</a>
                            </td>
                            <td>
                                <a href="{{ url('warranty-claims')}}">3</a>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                stroke="#575757" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#edit-modal">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function($) {
	 
		var table = $('#example5').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example6').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example7').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example8').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		$('#example tbody').on('click', 'tr', function () {
			var data = table.row( this ).data();
			
		});
	   
	})(jQuery);
</script>
@endpush