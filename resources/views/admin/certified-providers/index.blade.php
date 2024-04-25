@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Add New -->
    <div class="modal fade" id="add-profile">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Add INFINIGUARD® Certified Service Provider</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form id="providerForm" enctype="multipart/form-data">
                        @csrf
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
                                <div class="card-body">  
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
                                <div class="card-body">  
                                <img src="" class="img-fluid" id="profile-img" style="width:100px;height:auto;" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" id="submitBtn" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    {{-- <div class="modal fade" id="edit-profile">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit GLOBAL Profile</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label class="text-black font-w500">Company Administrator<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Company Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="text-black font-w500">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Phone<span class="text-danger">*</span></label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Company Logo<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="company-logo">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Profile Image<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="profile-image">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

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
                            <th> ID </th>
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
                            <th> ID </th>
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
                lengthMenu: [ 5, 10, 25, 50, 100],
                pageLength: 10,           
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                        url: "{!! route('admin.providers.index') !!}",
                        type: "GET",
                        dataType: 'json',
                    },  
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [5, 6, 7] },
                    { searchable: false, "targets": [5, 6, 7] },
                ],                                  
                columns: [
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
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
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
        var url = "{{ route('admin.providers.update', ':id') }}";
            url = url.replace(':id', certificationProviderId);
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

        function showValidationErorrs(errors){

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $.each(errors, function(key, value) {
                var field = $('[name="' + key + '"]');
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">' + value[0] + '</div>');
            });
            field.on('input', function() {
                field.removeClass('is-invalid');
                field.next('.invalid-feedback').remove();
            });

        }

        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData($('#providerForm')[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.providers.store') }}", // Use the store route for creating new providers
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                $('#add-profile').modal('hide');
                $('#providerForm')[0].reset(); // Reset the form                
                if(!response.status){
                    $('#successAlert').removeClass('alert-success'); 
                    $('#successAlert').addClass('alert-danger');      
                }
                $('#successAlert').fadeIn();
                $('#successAlert').text(response.message);

                    // Hide alert after 10 seconds (10000 milliseconds)
                    setTimeout(function() {
                        $('#successAlert').fadeOut();
                    }, 10000);

                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                        showValidationErorrs(errors);
                }
            });
        });

        $(document).on('click','.add-provider', function(e){
            e.preventDefault();
            let type=$(this).data('curd');
            if(type == 'edit'){
                $('#title').text('Edit INFINIGUARD® Certified Service Provider');
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

                        $('#providerAdministrator').val(response.data.provider_administrator);
                        $('#providerName').val(response.data.provider_name);
                        $('#providerEmail').val(response.data.provider_email);
                        $('#providerPhone').val(response.data.provider_phone);
                        $('#provider-pass').hide();
                        $('#logo').removeClass('d-none');
                        $('#profile-card').removeClass('d-none');
                        $('#logo-img').attr('src',response.data.provider_logo_image);
                        $('#profile-img').attr('src',response.data.provider_profile_image);
                     }
                    },
                    error: function(xhr, status, error) {
                       console.log(error);
                    }
                });
            }else{
                
                $('#title').text('ADD INFINIGUARD® Certified Service Provider');
                $('#providerAdministrator').val('');
                $('#providerName').val('');
                $('#providerEmail').val('');
                $('#providerPhone').val('');
                $('#provider-pass').show();
                $('#logo').addClass('d-none');
                $('#profile-card').addClass('d-none');
            }
           
        })

    });

</script>
@endpush