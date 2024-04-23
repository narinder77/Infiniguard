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
            <input type="hidden" id="providerId" value="{{ $CertifiedProvider->provider_id }}">
            <label class="switch">
              <input type="checkbox" id="togBtn" {{ $CertifiedProvider->provider_status == 1 ? 'checked' : '' }}>               
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
                            <th> Provider Logo </th>
                            <th> Provider Name </th>
                            <th> Provider Administrator </th>
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
        <h2 class="mb-0">INFINIGUARD® Certified Applicators for {{ $CertifiedProvider->provider_name ?? '' }}</h2> 
        <div>
            <a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addapplicator">Add
                More</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-outer">
            <div class="table-responsive card-table rounded table-hover fs-14">
                <table class="table border-no display mb-4 dataTablesCard project-bx" id="certifiedApplicators">
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
	    var providerId = $('#providerId').val();
         var url = "{{ route('admin.providers.show', ':id') }}";
             url = url.replace(':id', providerId);
        let CertifiedApplicators = $('#certifiedApplicators').DataTable({
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        "previous": "Previous",
                        "next": "Next"
                    }
                },
                pagingType: "simple_numbers",
                lengthMenu: [ 5, 10, 25, 50, 100],
                pageLength: 10,
                columnDefs: [{ width: '500', targets: 0 }],
                fixedColumns: false,
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                        url: url,
                        type: "GET",
                        dataType: 'json',
                        data: {
                                provider_id: providerId // Pass the provider ID as data
                            }
                    },
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [6, 7] },
                    { searchable: false, "targets": [6, 7] },
                ],
            columns: [
                    {data: 'applicator_certification_id', name: 'applicator_certification_id'},
                    {data: 'applicator_name', name: 'applicator_name'},
                    {data: 'applicator_email', name: 'applicator_email'},
					{data: 'applicator_date', name: 'applicator_date'},
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.registered-equipments.show', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">${row.registered_codes_count}</a>`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.warranty-claims.show', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">${row.warranty_claims_count}</a>`;
                        }
                    },
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let status = row.applicator_status;
    						let checkedAttribute = status == 1 ? 'checked' : '';
                            return `<div class="form-check form-switch">
										<input data-applicatorId="${row.applicator_id}" class="form-check-input" type="checkbox" id="certificationApplicatorStatus" name="" value="yes" ${checkedAttribute}>
									</div>`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="${baseUrl}/${applicator_id}" data-bs-toggle="modal" data-bs-target="#edit-profile">Edit</a>
                                        <a class="dropdown-item" href="${baseUrl}/${applicator_id}">Delete</a>
                                    </div>
                                </div>`;
                        }
                    },
                ]
            });
        $('#certifiedApplicators tbody').on('click', 'tr', function () {
            var data = CertifiedApplicators.row(this).data();
            // Do something with the data
        });
	   
	})(jQuery);


    $(document).ready(function() {
        $(document).on('change','#certificationApplicatorStatus',function() {
             var certificationApplicatorId= $(this).attr('data-applicatorId');
            var status = $(this).prop('checked') ? 'active' : 'revoked';
            
            // Construct the URL with the provider ID
            var url = "{{ route('admin.applicators.update', ':id') }}";
             url = url.replace(':id', certificationApplicatorId);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _method: 'PUT', // Since Laravel's resourceful route uses PUT method for update
                    status: status
                },
                headers: {
                     'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                        $('#successAlert').fadeIn();
                        $('#successAlert').text(response.message);
                        // Hide success alert after 3 seconds (3000 milliseconds)
                        setTimeout(function() {
                            $('#successAlert').fadeOut();
                        }, 3000);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#togBtn').change(function() {
            var providerId = $('#providerId').val();
            var status = $(this).prop('checked') ? 'active' : 'revoked';
            
            // Construct the URL with the provider ID
            var url = "{{ route('admin.providers.update', ':id') }}";
             url = url.replace(':id', providerId);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _method: 'PUT', // Since Laravel's resourceful route uses PUT method for update
                    status: status
                },
                headers: {
                     'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                        $('#successAlert').fadeIn();
                        $('#successAlert').text(response.message);
                        // Hide success alert after 3 seconds (3000 milliseconds)
                        setTimeout(function() {
                            $('#successAlert').fadeOut();
                        }, 3000);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });


</script>
@endpush