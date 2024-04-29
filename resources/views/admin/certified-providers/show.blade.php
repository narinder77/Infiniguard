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
                    <form id="applicatorForm"> 
                    @csrf 
                        <input type="hidden" value="{{ $CertifiedProvider->provider_id }}" id="certifiedProviderId" name="applicator_provider_id" class="form-control">
                    <div class="form-group">
                            <label class="text-black font-w500">Certification ID <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="applicator_certification_id" name="applicator_certification_id" placeholder="Enter Certification ID">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="applicator_name" name="applicator_name" placeholder="Enter Name">
                        </div>                       
                        <div class="form-group">
                            <label class="text-black font-w500">Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" id="applicator_email" name="applicator_email" placeholder="Enter Email">
                        </div>
                        <div class="form-group" id="applicator-pass">
                            <label class="text-black font-w500">Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="applicator_password" name="applicator_password" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Certification Date <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="applicator_date" name="applicator_date">
                        </div>
                        <div class="form-group">
                            <button type="button" id="submitBtn" class="btn btn-primary">SUBMIT</button>
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
            <a href="{{ route('admin.provider.edit2', $CertifiedProvider->provider_id) }}" class="btn btn-primary rounded mx-2">Edit Profile</a>
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
            <a href="#" class="btn btn-primary rounded add-applicator" data-curd="add" data-bs-toggle="modal" data-bs-target="#addapplicator">Add
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
<div class="modal fade" id="confirmationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Confirmation</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this applicator!!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
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
                    { orderable: false, "targets": [4,5,6, 7] },
                    { searchable: false, "targets": [4,5,6, 7] },
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
                            let baseUrl = "{{ route('admin.applicator.registerEquip', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">${row.registered_codes_count}</a>`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicator.warranty-claims', '') }}";
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
                                        <a class="dropdown-item add-applicator" href="javascript:void(0);" data-id="${applicator_id}" data-curd="edit" data-bs-toggle="modal" data-bs-target="#addapplicator ">Edit</a>
                                        <a class="dropdown-item delete-applicator" href="javascript:void(0);" data-id="${applicator_id}">Delete</a>
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
            var url = "{{ route('admin.applicator.updateStatus', ':id') }}";
             url = url.replace(':id', certificationApplicatorId);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    status: status
                },
                headers: {
                     'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                       showAlert('success', response.message, null);   
                },
                error: function(xhr, status, error) {
                    // Handle error
                    showAlert('danger', xhr.responseJSON.message, null);
                }
            });
        });
    });

    $(document).ready(function() {

        $('#togBtn').change(function() {
            var providerId = $('#providerId').val();
            var status = $(this).prop('checked') ? 'active' : 'revoked';
            
            // Construct the URL with the provider ID
            var url = "{{ route('admin.provider.updateStatus', ':id') }}";
             url = url.replace(':id', providerId);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    status: status
                },
                headers: {
                     'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                        showAlert('success', response.message, null);   
                },
                error: function(xhr, status, error) {
                    // Handle error
                    showAlert('danger', xhr.responseJSON.message, null);
                }
            });
        });

        $(document).on('click','.add-applicator', function(e){
            e.preventDefault();
            let type=$(this).data('curd');
            if(type == 'edit'){
                $('#submitBtn').attr('data-curd','edit');
                let applicatorId=$(this).data('id');
                var url = "{{ route('admin.applicators.edit', ':id') }}";
                    url = url.replace(':id', applicatorId);
                
                $.ajax({
                    type: 'GET',
                    url: url, 
                    processData: false,
                    contentType: false,
                    success: function(response) {                    

                     if(response.status){
                        
                    changeModelContent('Edit INFINIGUARD® Certified Applicator', 'Update',  'update', 'applicator_id', response.data.applicator_id, 'addapplicator');

                        var baseUrl="{{ asset('/storage') }}";                      
                        $('#applicator_certification_id').val(response.data.applicator_certification_id);
                        $('#applicator_name').val(response.data.applicator_name);
                        $('#applicator_email').val(response.data.applicator_email);
                        $('#applicator_password').val(response.data.applicator_password);
                        $('#applicator_date').val(response.data.applicator_date);
                        $('#applicator-pass').hide();  
                        }
                    },
                    error: function(xhr, status, error) {
                       console.log(error);
                    }
                });
            }else{

                changeModelContent('ADD INFINIGUARD® Certified Applicator','submit', 'submit', null, null, 'addapplicator');

                $('#submitBtn').attr('data-curd','add');
                $('#applicator_certification_id').val('');
                $('#applicator_name').val('');
                $('#applicator_email').val('');
                $('#applicator_password').val('');
                $('#applicator-pass').show();     
                $('#applicator_date').val('');
            }
           
        });

        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault(); // Prevent default form submission
            var type=$(this).attr('data-curd');
            var formData = new FormData($('#applicatorForm')[0]);
            var url="";
            if(type == 'add'){
                 url="{{ route('admin.applicators.store') }}";
            }else{
                let applicatorId= $('#applicator_id').val();
                url="{{ route('admin.applicators.update', ':id') }}";
                 url = url.replace(':id', applicatorId);
               
            }           

            $.ajax({
                type: 'POST',
                url: url, // Use the store route for creating new providers
                data: formData,
                processData: false,
                contentType: false,
                 beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // Set CSRF token
                    if (type != 'add') {
                        xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT'); // Set method override for Laravel (only for updating)
                    }
                },
                success: function(response) {
                    $('#addapplicator').modal('hide');
                    $('#applicatorForm')[0].reset(); // Reset the form                
                    if(response.status){
                        showAlert('success', response.message, null);   
                    }else{
                         showAlert('danger', response.message, null);   
                    }                   
                    $('#certifiedApplicators').DataTable().ajax.reload();

                },
                error: function(xhr, status, error) {
                   if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;                        
                        showValidationErorrs(errors);
                    } else {
                        // Handle other types of errors
                        showAlert('danger', xhr.responseJSON.message, null);
                        // You can display a generic error message here
                    }
                }
            });
        });

        $(document).on('click','.delete-applicator',function(e){
            e.preventDefault();
            var applicatorId=$(this).data('id');           
            $("#confirmDelete").attr("data-id", applicatorId);

            // Show the confirmation modal
            $("#confirmationModal").modal('show');
            
        });

        // Handle delete confirmation
        $("#confirmDelete").on('click', function() {
            var applicatorId = $(this).attr('data-id');
            var url = "{{ route('admin.applicators.destroy', ':id') }}";
            url = url.replace(':id', applicatorId);
            
            // Send AJAX request to delete provider
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {
                    if(response.status){
                         $('#certifiedApplicators').DataTable().ajax.reload();
                         // Optionally, you can perform actions after successful deletion
                    }
                
                },
                error: function(xhr, status, error) {
                   showAlert('danger', xhr.responseJSON.message, null);
                    // Optionally, you can handle errors here
                }
            });

            // Close the confirmation modal
            $("#confirmationModal").modal('hide');
        });
    });


</script>
@endpush