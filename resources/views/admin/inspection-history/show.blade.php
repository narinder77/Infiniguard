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
        <div class="modal modal-lg fade" id="client-info">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Client information for INFINIGUARD® QR number {{ $qr_number->equipment_qr_number ?? '' }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addClientEquipmentForm">
                    <input type="hidden" name="qr_id" value="{{ $qr_number->equipment_qr_id }}">
                        @csrf
                        <div class="form-group">
                            <label class="text-black font-w500">Client<span class="text-danger">*</span></label>                            
                                <select name="client_id" required id="client_id" class="form-select form-control" aria-label="Default select example">
                                <option value="" selected>Select client</option>   
                                @forelse($clients as $client)
                                    <option value="{{ $client->client_id }}">{{ $client->provider_name ?? ""}} {{ $client->client_firstname ?? "" }} {{ $client->client_lastname ?? ""}}</option>   
                                @empty
                                    <option value=""></option>   
                                @endforelse
                                                        
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Maintenance Reminder<span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="maintenanceReminder" id="reminder1" checked>
                                <label class="form-check-label" for="reminder1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="maintenanceReminder" id="reminder2">
                                <label class="form-check-label" for="reminder2">
                                    No
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Days until maintenance reminder<span
                                        class="text-danger">*</span></label>
                                <input type="number" required min="1" max="90" name="reminderDays" id="reminderDays" class="form-control">
                            <div class="text-danger d-none remider-alert">
                                Value must be greater than 0 and less than 90.
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Next Maintenance Reminder Date<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nextReminderDate" id="nextReminderDate" class="form-control">
                            </div>
                        </div>                     

                        <div class="form-group">
                            <label class="text-black font-w500">Reminder Language<span class="text-danger">*</span></label>
                            <select name="reminderLang" required id="reminderLang" class="form-select form-control" aria-label="Default select example">
                             <option value="1" selected>English</option> 
                             <option value="2">Spanish</option>                                
                            </select>
                        </div><hr>

                        <div class="form-check my-3">
                        <input class="form-check-input" name="additionalInfo" checked type="checkbox" value="1" id="additional-info">
                        <label class="form-check-label" for="additional-info">
                            Additional Contact Info
                        </label>                       
                        </div> 
                        <div id="contact-div">
                            <div class="row contact-row">
                                <div class="col-5">          
                                    <div class="form-group">
                                        <label class="text-black font-w500">Contact Name<span
                                                class="text-danger">*</span></label>
                                        <input type="password" required name="client_password" class="form-control contact-email">
                                    </div>
                                </div>
                                <div class="col-5"> 
                                    <div class="form-group">
                                        <label class="text-black font-w500">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="password" required name="client_password" class="form-control contact-email">
                                    </div>
                                </div>
                                <div class="col-2 d-flex justify-content-center mt-4">
                                    <div class="form-group text-end">
                                        <button type="button" class="btn btn-danger remove-contact"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>                              
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group text-end">
                            <button type="button" class="btn btn-success add-contact"><i class="fa fa-plus" aria-hidden="true"></i>  Add Contact</button>
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="submitBtn" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
      
        <div class="heading-part d-block mb-3 pb-3 border-bottom">
            <h3 class="mb-0"> {{$title}}</h3>
            <div class="text-end mt-3">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-id="{{ $qr_number->equipment_qr_id }}" data-bs-target="#client-info" class="btn btn-primary rounded client-btn">Client</a>
                <a href="{{ route('admin.insepection.downloadPdf',$qr_number->equipment_qr_id) }}" class="btn btn-primary rounded">Download Inspection Report</a>
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

    $(document).ready(function(){

        $(document).on("click",".client-btn", function(e){
              e.preventDefault(); 
            var id =$(this).attr("data-id");
                var url = "{{ route('admin.client-info', ':id') }}";
                    url = url.replace(':id', id);
                
                $.ajax({
                    type: 'GET',
                    url: url, 
                    processData: false,
                    contentType: false,
                    success: function(response) {                    

                     if(response.status){ 
                        $("#client_id").val(response.clientEquipmentData.client_id ?? '');
                        if(response.clientEquipmentData.client_maintenance_reminder == 1){
                            $("#reminder1").attr("checked", true);
                        }else{
                            $("#reminder2").attr("checked", true);
                        }
                        $("#nextReminderDate").val(response.nextReminderDate ?? '');
                        $("#reminderLang").val(response.clientEquipmentData.client_reminder_language ?? '');
                        $("#reminderDays").val(response.clientEquipmentData.client_reminder_days);
                        if(response.clientAdditionalInfo){
                            var client_info=response.clientAdditionalInfo; 
                             $('#contact-div').empty();
                            $.each(client_info, function(index, client) {
                                addContact(client);
                            });
                        }                                          
                      
                     }
                    },
                    error: function(xhr, status, error) {
                       console.log(error);
                    }
                });        
        })

        // Add contact
        $(document).on("click",".add-contact",function(){
            addContact();
        });

        // Remove contact
        $(document).on("click", ".remove-contact", function(){
            $(this).closest('.contact-row').remove();
        });

        $(document).on('change','#additional-info', function(){
            if($(this).is(":checked")) {
                $('#contact-div').show();               
            } else {
                $('#contact-div').hide();
            }
        })        

        function addContact(client=""){
                var contactRow = `<div class="row contact-row"> 
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="text-black font-w500">Contact Name<span class="text-danger">*</span></label>
                                        <input type="text" required value="${client.ContactName ?? ""}" name="contact_name[]" class="form-control contact-email">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="text-black font-w500">Email<span class="text-danger">*</span></label>
                                        <input type="email" required value="${client.Email ?? ""}" name="contact_email[]" class="form-control contact-email">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center mt-4">
                                    <div class="form-group text-end">
                                        <button type="button" class="btn btn-danger remove-contact"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>`;
            $("#contact-div").append(contactRow);
        }

        $(document).on("input","#reminderDays", function(e){
            e.preventDefault(); 

            var value=$(this).val();
            if(value != "" && value <= 0 || value > 90)
            {
                $(".remider-alert").removeClass("d-none");
            }else{
                $(".remider-alert").addClass("d-none");
            }

        })

        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault();
            var error=emailVlidation();
            console.log(error);

            var formData = new FormData($('#addClientEquipmentForm')[0]);
            var url="{{ route('admin.store-client-equipment') }}";
                       
            $.ajax({
                type: 'POST',
                url: url, // Use the store route for creating new providers
                data: formData,
                processData: false,
                contentType: false,             
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
    });

    emailVlidation();

    function emailVlidation(){
       $(document).on('blur','.contact-email',function() {
        var currentEmail = $(this).val();
        var existingEmails = [];
        $('.contact-email').not(this).each(function() {
            existingEmails.push($(this).val());
        });
        if ($.inArray(currentEmail, existingEmails) !== -1) {
            $(this).val('');
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
                var field =$(this);
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">Email must be unique</div>');

                // Remove error message and invalid class when the field is focused
                field.focus(function() {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                });
        }
     });
    }
    </script>
@endpush
