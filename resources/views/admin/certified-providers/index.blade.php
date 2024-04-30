@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Add New -->
    <div class="modal fade" id="add-profile">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Add INFINIGUARD® Certified Provider</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="providerForm" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" id="certifiedProviderId" name="certifiedProviderId" class="form-control"> --}}
                        <div class="form-group">
                            <label class="text-black font-w500">Certified Provider Administrator</label>
                            <input type="text" placeholder="Enter Certified Provider Administrator" id="providerAdministrator" name="providerAdministrator" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Certified Provider Name<span class="text-danger">*</span></label>
                            <input type="text" placeholder="Enter Certified Provider Name" id="providerName" name="providerName" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="text-black font-w500">Email<span class="text-danger">*</span></label>
                            <input type="email" placeholder="Enter Email" id="providerEmail" name="providerEmail" class="form-control">
                        </div>
                        <div class="form-group" id="provider-pass">
                            <label class="text-black font-w500">Password<span class="text-danger">*</span></label>
                            <input type="password" placeholder="Enter Password" id="providerPassword" name="providerPassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Phone<span class="text-danger">*</span></label>
                            <input type="tel" placeholder="Enter Phone" id="providerPhone" name="providerPhone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Certified Provider Logo<span class="text-danger">*</span></label>
                            <input class="form-control" name="providerLogo" type="file" id="company-logo">
                        </div>
                        
                        <div class="col-6 d-none" id="logo">
                            <div class="card">
                                <div class="card-body text-center">  
                                <img src="" class="img-fluid" id="logo-img" style="width:100px;height:auto;" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Profile Image<span class="text-danger">*</span></label>                            
                            <input class="form-control" name="providerImage"  type="file" id="profile-image">
                        </div>
                       <div class="col-6 d-none" id="profile-card">
                            <div class="card">
                                <div class="card-body text-center">  
                                <img src="" class="img-fluid" id="profile-img" style="width:100px;height:auto;" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" data-curd="" id="submitBtn" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
        <h3 class="mb-0">INFINIGUARD® Certified Providers</h3>
        <div>
            <a href="#" class="btn btn-primary rounded add-provider" data-curd="add" data-bs-toggle="modal" data-bs-target="#add-profile">Add</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-outer">
            <div class="table-responsive card-table rounded table-hover fs-14">
                <table class="table border-no display mb-4 dataTablesCard project-bx dataTables_wrapper" id="CertifiedProvider">
                    <thead>
                        <tr>
                            {{-- <th>Provider ID </th> --}}
                             <th>ID </th>
                             <th>Provider ID </th>
                            <th> Certified Providers </th>
                            <th> Certified Providers Administrator </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Certified Providers Status </th>
                            <th> More Info </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            {{-- <th>Provider ID </th> --}}
                            <th>ID </th>
                            <th>Provider ID </th>
                            <th> Certified Providers </th>
                            <th> Certified Providers Administrator </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Certified Providers Status </th>
                            <th> More Info </th>
                            <th> Action </th>
                        </tr>
                    </tfoot>                    
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
                <p>Are you sure you want to delete this provider!!</p>
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
            let sortOrderByColumn = '';
            let sortDirection='';
            let CertifiedProvider = $('#CertifiedProvider').DataTable({
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        "previous": "Previous",
                        "next": "Next"
                    }
                },  
                pagingType: "simple_numbers",
                lengthMenu: [5, 10, 25, 50, 100],
                pageLength: 10,           
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                        url: "{!! route('admin.providers.index') !!}",
                        type: "GET",
                        dataType: 'json',
                    },  
                order: [[1, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [5,6, 7] },
                    { searchable: false, "targets": [5,6, 7] },
                     {
                        'visible': false,
                        'targets': [1]
                    }
                ],                                  
                columns: [
                    {data: 'id', name: 'id'},  
                    {data: 'provider_id', name: 'provider_id'},                  
                    {data: 'provider_name', name: 'provider_name'},
                    {data: 'provider_administrator', name: 'provider_administrator'},
                    {data: 'provider_email', name: 'provider_email'},
                    {data: 'provider_phone', name: 'provider_phone'},
					{ 
                        data: null,
                        'width':'100px',
                        render: function (data, type, row, meta) {
                            let status = row.provider_status;
    						let checkedAttribute = status == 1 ? 'checked' : ''; 
                            return `<div class="form-check form-switch">
										<input data-certificationProviderId="${row.provider_id}" class="form-check-input" type="checkbox" id="certificationStatus" name="" value="yes" ${checkedAttribute}>
									</div>`;
                        }
                    },                    
                    { 
                        data: null,
                        render: function (data, type, row, meta) {
                            let provider_id = row.provider_id;
                            let baseUrl = "{{ route('admin.providers.show', '') }}";
                            return `<a href="${baseUrl}/${provider_id}" class="btn btn-info d-block rounded">View More Info</a>`;
                        }
                    },
                    { 
                        data: null,
                        render: function (data, type, row, meta) {
                            let provider_id = row.provider_id;
                            let baseUrl = "{{ route('admin.providers.show', '') }}";
                            return `<div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item add-provider" data-id="${provider_id}" href="javascript:void(0);" data-curd="edit" data-bs-toggle="modal" data-bs-target="#add-profile">Edit</a>
                                        <a class="dropdown-item delete-provider" href="javascript:void(0);" data-id="${provider_id}">Delete</a>
                                    </div>
                                </div>`;
                        }
                    },
                ]
            }); 
           

            $('#CertifiedProvider tbody').on('click', 'tr', function() {
                var data = CertifiedProvider.row(this).data();
            });
        })(jQuery);

    $(document).ready(function() {
        $(document).on('change','#certificationStatus',function() {

        var certificationProviderId = $(this).attr('data-certificationProviderId');           
        var status = $(this).prop('checked') ? 'active' : 'revoked';
        var url = "{{ route('admin.provider.updateStatus', ':id') }}";
            url = url.replace(':id', certificationProviderId);
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
       
        $(document).on('click','.add-provider', function(e){            
            e.preventDefault();
            let type=$(this).data('curd');
            if(type == 'edit'){
                $('#submitBtn').attr('data-curd','edit');
                let providerId=$(this).data('id');
                var url = "{{ route('admin.providers.edit', ':id') }}";
                    url = url.replace(':id', providerId);
                
                $.ajax({
                    type: 'GET',
                    url: url, 
                    processData: false,
                    contentType: false,
                    success: function(response) {                    

                     if(response.status){                                              
                        var baseUrl="{{ asset('/storage') }}";
                       changeModelContent('Edit INFINIGUARD® Certified Provider', 'Update',  'update', 'certifiedProviderId', response.data.provider_id, 'add-profile');

                        $('#providerAdministrator').val(response.data.provider_administrator);
                        $('#providerName').val(response.data.provider_name);
                        $('#providerEmail').val(response.data.provider_email);
                        $('#providerPhone').val(response.data.provider_phone);
                        $('#provider-pass').hide();
                        $('#logo').removeClass('d-none');
                        $('#profile-card').removeClass('d-none');
                        $('#logo-img').attr('src',baseUrl+'/'+response.data.provider_logo_image);
                        $('#profile-img').attr('src',baseUrl+'/'+response.data.provider_profile_image);
                     }
                    },
                    error: function(xhr, status, error) {
                       console.log(error);
                    }
                });
            }else{
                changeModelContent('ADD INFINIGUARD® Certified Provider','submit', 'submit', null, null, 'add-profile');
                $('#submitBtn').attr('data-curd','add');
                $('#providerAdministrator').val('');
                $('#providerName').val('');
                $('#providerEmail').val('');
                $('#providerPhone').val('');
                $('#provider-pass').show();
                $('#logo').addClass('d-none');
                $('#profile-card').addClass('d-none');
                $('#logo-img').attr('src','');
                $('#profile-img').attr('src','');
            }
           
        });

        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault(); // Prevent default form submission
            var type=$(this).attr('data-curd');
            var formData = new FormData($('#providerForm')[0]);
            var url="";
            if(type == 'add'){
                 url="{{ route('admin.providers.store') }}";
            }else{
                let providerId= $('#certifiedProviderId').val();
                url="{{ route('admin.providers.update', ':id') }}";
                 url = url.replace(':id', providerId);
               
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
                    $('#add-profile').modal('hide');              
                  if(response.status){
                     showAlert('success', response.message, null)    
                    }else{
                       showAlert('danger', response.message, null)
                    }                                           
                    $('#CertifiedProvider').DataTable().ajax.reload();

                },
                error: function(xhr, status, error) {
                   if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;                        
                        showValidationErorrs(errors);
                    } else {
                        // Handle other types of errors
                       $('#add-profile').modal('hide');
                       showAlert('danger', xhr.responseJSON.message, null)
                        // You can display a generic error message here
                    }
                }
            });
        });

        $(document).on('click','.delete-provider',function(e){
            e.preventDefault();
            var providerId=$(this).data('id');          
            $("#confirmDelete").data("id", providerId);

            // Show the confirmation modal
            $("#confirmationModal").modal('show');
            
        });

        // Handle delete confirmation
        $("#confirmDelete").on('click', function() {
            var providerId = $(this).data('id');
            var url = "{{ route('admin.providers.destroy', ':id') }}";
            url = url.replace(':id', providerId);
            
            // Send AJAX request to delete provider
            $.ajax({
                url: url,
                method: 'DELETE',
                success: function(response) {
                    if(response.status){
                         $('#CertifiedProvider').DataTable().ajax.reload();
                         // Optionally, you can perform actions after successful deletion
                    }
                
                },
                error: function(xhr, status, error) {      
                    // Optionally, you can handle errors here
                       showAlert('danger', xhr.responseJSON.message, null);
                }
            });

            // Close the confirmation modal
            $("#confirmationModal").modal('hide');
        });

    });

</script>
@endpush