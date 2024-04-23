@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Add New -->
    <div class="modal fade" id="add-profile">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Certified Service Provider</h5>
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
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit-profile">
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
    </div>

    <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
        <h3 class="mb-0">INFINIGUARD® Certified Providers</h3>
        <div>
            <a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#add-profile">Add</a>
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
                                        <a class="dropdown-item" href="${baseUrl}/${provider_id}" data-bs-toggle="modal" data-bs-target="#edit-profile">Edit</a>
                                        <a class="dropdown-item" href="${baseUrl}/${provider_id}">Delete</a>
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

    $(document).on('change','#certificationStatus',function() {
       var certificationProviderId = $(this).attr('data-certificationProviderId');
        console.log(certificationProviderId);
        var status = $(this).prop('checked') ? 'active' : 'revoked';
        
        // Construct the URL with the provider ID
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
                // Handle success response if needed
              //  console.log(response);
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
</script>
@endpush