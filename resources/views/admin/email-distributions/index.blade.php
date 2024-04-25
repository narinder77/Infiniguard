@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Add Order -->
    <div class="modal fade" id="addEmailModel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Mail</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmail">
                        <div class="form-group">
                            <label class="text-black font-w500">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" id="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addEmailModel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Email</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmail">
                        <div class="form-group">
                            <label class="text-black font-w500">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" id="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
        <h3 class="mb-0">Email Distribution List</h3>
        <div>
            <a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addEmailModel">Add New
                Mail</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 table-outer">
            <div class="table-responsive card-table rounded table-hover fs-14">
                <table class="table border-no display mb-4 dataTablesCard project-bx" id="emailDistribution">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Email </th>
                            <th> Created Date </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                        <tr>
                            <th> ID </th>
                            <th> Email </th>
                            <th> Created Date </th>
                            <th> Action </th>
                        </tr>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')
<script>
    (function($) {
    $(document).ready(function() {
        let emailDistribution = $('#emailDistribution').DataTable({
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
            columnDefs: [{
                width: '500',
                targets: 0
            }],
            fixedColumns: false,
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.email-distribution-list.index') }}",
                type: "GET",
                dataType: 'json',
                data: {
                    provider_id: '' // Pass the provider ID as data
                }
            },
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                    orderable: false,
                    "targets": [2, 3]
                },
                {
                    searchable: false,
                    "targets": [2, 3]
                },
            ],
            columns: [
				{
                    "data": "id"
                },
                {
                    "data": "email"
                },
                {
                    "data": "created_at"
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return `
                        <div class="dropdown">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a data-id="${row.id} id="edit" class="edit dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addEmailModel">Edit</a>
                                <a data-id="${row.id} id="delete" class="delete dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                        `;
                    }
                }
            ]
        });
        /*=============================================
         Function for validation and show errors
        ===============================================*/
        function showValidationErorrs(errors){
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $.each(errors, function(key, value) {
                var field = $('[name="' + key + '"]');
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">' + value[0] + '</div>');
            });
        }
        /*=============================================
         Create recorde
        ===============================================*/
        $(document).on('click', '#submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.email-distribution-list.store') }}",
				type: 'POST',
                dataType: "json",
                data: $('#addEmail').serialize(),
                success: function(response) {
                    $('#addEmail')[0].reset();
                    emailDistribution.ajax.reload();
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    showValidationErorrs(errors);

                }
            });
        });
        /*=============================================
         Edit recorde
        ===============================================*/        
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.email-distribution-list.edit', ':id') }}".replace(':id', id),
                method: 'GET',
                dataType: "json",
                success: function(response) {
                    $('input[name="email"]').val(response.data.email);
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    showValidationErorrs(errors);
                }
            });
        });
        /*=============================================
         Update recorde
        ===============================================*/        
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.email-distribution-list.update', ':id') }}".replace(':id', id),
                method: 'GET',
                dataType: "json",
                success: function(response) {
                    $('input[name="email"]').val(response.data.email);
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    showValidationErorrs(errors);
                }
            });
        });        
        /*=============================================
         Delete recorde
        ===============================================*/          
    });
})(jQuery);
</script>
@endpush