@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Add Order -->
        <div class="modal fade modal-lg" id="update-notes">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notes for INFINIGUARD® QR number 0000360</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updaeNotesForm">
                            @csrf
                            <div class="form-group claim_status">
                                <label class="text-black font-w500">Status</label>
                                <select name="equipment_claim_status" id="equipment_claim_status" class="form-select form-control" aria-label="Default select example">
                                    <option value="1" selected>Answered</option>
                                    <option value="0">Unanswered</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Notes<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="equipment_claim_notes" id="equipment_claim_notes" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" id="updateBtn" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @php
          $equip_data=array();
        if($qr_number->registeredCodes[0]->condenser=="1"){
            $equip_data[]='condenser coils';
        }
        if($qr_number->registeredCodes[0]->cabinet=="1"){
            $equip_data[]='cabinet';
        }
        //if($qr_number->registeredCodes[0]->evaporator!="0"){
        //    $equip_data[]='evaporator coils '.$qr_number->registeredCodes[0]->evaporator;
       // }
        $equip_data = implode(' and ', $equip_data)
        @endphp
        <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
            <h3 class="mb-0"> INFINIGUARD&#174;  Record for QR {{ $qr_number->equipment_qr_number}}, {{$equip_data}} <br> protected with INFINIGUARD®</h3>
            <div>
                <a href="{{ url('qr-client-information') }}" class="btn btn-primary rounded">Client</a>
                <a href="{{ route('admin.insepection.downloadPdf') }}" class="btn btn-primary rounded">Download Inspection Report</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 table-outer">
                <div class="table-responsive card-table rounded table-hover fs-14">
                    <table class="table border-no display mb-4 dataTablesCard project-bx" id="WarrantyInspectedRecords">
                        <thead>
                            <tr>
                                <th>ID </th>
                                <th>Date </th>
                                <th>Time </th>
                                <th>Activity </th>
                                <th>Location </th>
                                <th>Notes/Claim </th>
                                <th>Inspection Pictures </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID </th>
                                <th>Date </th>
                                <th>Time </th>
                                <th>Activity </th>
                                <th>Location </th>
                                <th>Notes/Claim </th>
                                <th>Inspection Pictures </th>
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
            let id = getLastPathname();
            let WarrantyInspectedRecords = $('#WarrantyInspectedRecords').DataTable({
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
                    url: "{{ route('admin.inspection-history.show', ':id') }}".replace(':id', id),
                    type: "GET",
                    dataType: 'json',
                    data: {
                        id: id
                    }
                },
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        orderable: false,
                        "targets": [0,1,2,3, 4, 5,6]
                    },
                    {
                        searchable: false,
                        "targets": [3, 4, 5,6]
                    },
                    {
                        'visible': false,
                        'targets': [0]
                    }
                ],
                columns: [{
                        data: 'inspection_id',
                        name: 'inspection_id'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'activity',
                        name: 'activity'
                    },
                    {
                        data: 'inspection_address',
                        name: 'inspection_address'
                    },
                    {
                        data: 'notes_link',
                        name: 'notes_link'
                   
                    },
                    {
                        data: 'inspection_link',
                        name: 'inspection_link'
                     
                    },
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);

        $(document).on('click', '.add-notes', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var type = $(this).data('type');
            var url = type == "registration" ? "{{ route('admin.registered-equipments.edit', ':id') }}" : "{{ route('admin.warranty-claims.edit', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    if (response.status) {
                        var editId='';
                        var notes='';
                        if(response.type == "register"){
                             $('.claim_status').hide();
                            editId=response.data.id;
                            notes=response.data.notes;

                        }else if(response.type == "warranty"){
                            editId=response.data.equipment_claim_id;
                             $('.claim_status').show();
                            $('#equipment_claim_status').val(response.data.equipment_claim_status);
                             notes=response.data.equipment_claim_notes;
                        }else{
                            editId=response.data.inspection_id;
                            $('.claim_status').hide();
                             notes=response.data.inspection_notes;
                        }   
                        $('#updateBtn').attr('data-type',response.type);
                        $('#updateBtn').attr('data-id',editId);
                        $('#equipment_claim_notes').val(notes);
                        changeModelContent(response.title, 'Update',  'update', 'type', response.type, 'update-notes');
   
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '#updateBtn', function(e) {
            e.preventDefault(); // Prevent default form submission
            var type=$(this).attr('data-type');
            var id=$(this).attr('data-id');
            var formData = new FormData($('#updaeNotesForm')[0]);
            var url = type == "register" ? "{{ route('admin.register-equp.updateNotes', ':id') }}" : "{{ route('admin.warranty-claims.update', ':id') }}";
            url = url.replace(':id', id);         

            $.ajax({
                type: 'POST',
                url: url, // Use the store route for creating new providers
                data: formData,
                processData: false,
                contentType: false,
                 beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}'); // Set CSRF token
                    if (type != 'register') {
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
                    $('#WarrantyInspectedRecords').DataTable().ajax.reload();

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

    </script>
@endpush
