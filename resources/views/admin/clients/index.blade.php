@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Add Order -->
        <div class="modal fade" id="addClientModel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add INFINIGUARD Client</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
						<div id="alert-container"></div>
                        <form id="addClientForm">
                            @csrf
                            <div class="form-group">
                                <label class="text-black font-w500">Company Name<span class="text-danger">*</span></label>
                                <input type="text" name="client_company_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Client First Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="client_firstname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Client Last Name<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="client_lastname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Client Phone Number<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="client_phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="text-black font-w500">Client Email<span class="text-danger">*</span></label>
                                <input type="email" name="client_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Client Provider<span
                                        class="text-danger">*</span></label>
                                <select name="client_provider_id" class="form-select form-control" aria-label="Default select example">
                                    <option selected>Armor Coat</option>
                                    <option value="1">Armor Coat</option>
                                    <option value="2">Armor Coat</option>
                                    <option value="3">Armor Coat</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Client Password<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="client_password" class="form-control">
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
            <h3 class="mb-0">Clients</h3>
            <div>
                <a href="#" class="btn btn-primary rounded addNewClient">Add</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 table-outer">
                <div class="table-responsive card-table rounded table-hover fs-14">
                    <table class="table border-no display mb-4 dataTablesCard project-bx" id="clients">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Certified Providers </th>
                                <th> Client Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Provider Name </th>
                                <th> Equipment </th>
                                <th> Edit </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> ID </th>
                                <th> Certified Providers </th>
                                <th> Client Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Provider Name </th>
                                <th> Equipment </th>
                                <th> Edit </th>
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
            $(document).ready(function() {
                let clients = $('#clients').DataTable({
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
                        url: "{!! route('admin.clients.index') !!}",
                        type: "GET",
                        dataType: 'json',
                    },
                    order: [
                        [0, 'asc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            "targets": [6, 7]
                        },
                        {
                            searchable: false,
                            "targets": [6, 7]
                        },
                    ],
                    columns: [{
                            data: 'client_id',
                            name: 'client_id'
                        },
                        {
                            data: 'client_company_name',
                            name: 'client_company_name'
                        },
                        {
                            data: null,
                            name: 'client_firstname',
                            render: function(data, type, row, meta) {
                                let firstname = row.client_firstname;
                                let lastname = row.client_lastname;
                                return `${firstname} ${lastname}`;
                            }
                        },
                        {
                            data: 'client_email',
                            name: 'client_email'
                        },
                        {
                            data: 'client_phone',
                            name: 'client_phone	'
                        },
                        {
                            data: 'certified_providers.provider_name',
                            name: 'provider_name'
                        },
                        {
                            data: 'client_id',
                            name: 'client_id'
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
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
                                    </div>
                                </div>`;
                            }
                        },
                    ]
                });
                /*=============================================
                     Function for reset form
                    ===============================================*/
                function resetForm() {
                    $('#addClientForm')[0].reset();
                }

                $('#addClientModel').on('hidden.bs.modal', function(e) {
					$('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    resetForm();
                });
                $(document).on('click', '.addNewClient', function(e) {
                    changeModelContent('Add INFINIGUARD® Client', 'submit', 'submit');
                })

                /*=============================================
                 Function for validation and show errors
                ===============================================*/
                function showValidationErorrs(errors) {
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    $.each(errors, function(key, value) {
                        var field = $('[name="' + key + '"]');
                        field.addClass('is-invalid');
                        field.after('<div class="invalid-feedback">' + value[0] + '</div>');

                        // Remove error message and invalid class when the field is focused
                        field.focus(function() {
                            $(this).removeClass('is-invalid');
                            $(this).next('.invalid-feedback').remove();
                        });
                    });
                }
                /*=============================================
                 Function for messages and show errors
                ===============================================*/
                function showAlert(type, message, alertlocation) {
                    var alert = $('<div class="alert alert-' + type +
                        ' alert-dismissible fade show" role="alert">' + message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                    $('#alert-container').append(alertlocation ? alertlocation : alert);
                    setTimeout(function() {
                        alert.alert('close');
                    }, 2000);
                }
                /*=============================================
                 Function for change title and button text and class
                ===============================================*/
                function changeModelContent(title, btntext, btnclass, input_name, input_value) {
                    $(".modal-header .modal-title").text(title);
                    $(".modal-body button").text(btntext).removeClass("submit").addClass(btnclass);
                    if ((typeof input_name !== 'undefined' && input_name !== null)) {
                        var hiddenInput = $('<input>').attr({
                            type: 'hidden',
                            id: input_name,
                            class: 'hiddenInput_Js',
                            name: input_name,
                            value: input_value
                        });
                        $(".modal-body form").append(hiddenInput);
                    } else {
                        $(".hiddenInput_Js").remove();
                    }
                    $("#addClientModel").modal('show');
                }
                /*=============================================
                 Create recorde
                ===============================================*/
                $(document).on('click', '.submit', function(e) {
                    e.preventDefault();
                    let formData = $('#addClientForm').serialize();
                    $.ajax({
                        url: "{{ route('admin.clients.store') }}",
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                        success: function(response, xhr, status, error) {
                            resetForm();
                            showAlert('success', response.message);
                            if (clients && clients.ajax) {
                                clients.ajax.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.responseJSON.message;
                            var errors = xhr.responseJSON.errors;
                            if (errors) {
                                showValidationErorrs(errors);
                            }
                            if (errorMessage) {
                                showAlert('danger', errorMessage);
                            }
                        }
                    });
                });
                /*=============================================
                 Edit recorde
                ===============================================*/
                $(document).on('click', '.edit', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    changeModelContent('Edit Email', 'Update', 'update', 'emailID', id);
                    $.ajax({
                        url: "{{ route('admin.email-distribution-list.edit', ':id') }}".replace(
                            ':id', id),
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
                $(document).on('click', '.update', function(e) {
                    e.preventDefault();
                    let id = $('input[name="emailID"]').val();
                    let formData = $('#addEmail').serialize();
                    $.ajax({
                        url: "{{ route('admin.email-distribution-list.update', ':id') }}"
                            .replace(':id', id),
                        method: 'PUT',
                        dataType: "json",
                        data: formData,
                        success: function(response, xhr, status, error) {
                            resetForm();
                            showAlert('success', response.message);
                            if (emailDistribution && emailDistribution.ajax) {
                                emailDistribution.ajax.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.responseJSON.message;
                            var errors = xhr.responseJSON.errors;
                            if (errors) {
                                showValidationErorrs(errors);
                            }
                            if (errorMessage) {
                                showAlert('danger', errorMessage);
                            }
                        }
                    });
                });
                /*=============================================
                 Delete recorde
                ===============================================*/
                $(document).on('click', '.delete', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('admin.email-distribution-list.destroy', ':id') }}"
                            .replace(':id', id),
                        method: 'DELETE',
                        dataType: "json",
                        success: function(response) {
                            emailDistribution.ajax.reload();
                            showAlert('success', response.message);
                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            showValidationErorrs(errors);
                        }
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
