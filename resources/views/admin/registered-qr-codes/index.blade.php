@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

	<!-- Add Order -->
	<div class="modal fade" id="update-serial">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Serial Number</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="updateSerialNumberForm">
						<div class="form-group">
							<label class="text-black font-w500">Serial Number<span class="text-danger">*</span></label>
							<input name="registered_equipment_id" id="registered_equipment_id" type="hidden" class="form-control">

							<input name="serial_number" id="serial_number" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Confirm Serial Number<span
									class="text-danger">*</span></label>
							<input name="serial_number_confirmation" id="serial_number_confirmation" type="text" class="form-control">
						<div id="serial_numb_match_message"></div>
						</div>
						<div class="form-group">
							<button type="button" id="updateSerial" class="btn btn-primary">SUBMIT</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Registered Equipments</h3>
		<div>
			<a href="{{ route('admin.register-equp.export') }}" class="btn btn-primary rounded">Download Data Into Spreadsheet</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 table-outer">
			<div class="table-responsive card-table rounded table-hover fs-14">
				<table class="table border-no display mb-4 dataTablesCard project-bx" id="RegisteredQrCode">
					<thead>
						<tr>
							<th> Customer Name </th>
							<th> Certification ID </th>
							<th> Clients </th>
							<th> QR Number </th>
							<th> Equipment Serial Number </th>
							<th> Application Date </th>
							<th> Last Maintenance Date </th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<thead>
						<tr>
							<th> Customer Name </th>
							<th> Certification ID </th>
							<th> Clients </th>
							<th> QR Number </th>
							<th> Equipment Serial Number </th>
							<th> Application Date </th>
							<th> Last Maintenance Date </th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
    (function($) {
			let CertifiedApplicator = $('#RegisteredQrCode').DataTable({
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
				fixedColumns: false,
                processing: true,
                responsive: true,
                serverSide: true,
				ajax: {
                        url: "{!! route('admin.registered-equipments.index') !!}",
                        type: "GET",
						dataType: 'json',
                    },
                order: [[3, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [2, 5, 6 ] },
                    { searchable: false, "targets": [2, 5, 6] },
                ],
                columns: [

					{data: 'certified_providers.provider_name',name: 'provider_name'},

                    {data: 'certified_applicators.applicator_certification_id', name: 'applicator_certification_id'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">client</a>`;
                        }
                    },
                    {data: 'equipment_qr_id', name: 'equipment_qr_id'},
					{
                        data: 'equipment_qr_id',
                        name: 'equipment_serial_number',
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="javascript:void(0)" data-id="${data}" class="btn btn-info d-block rounded update-serial" data-bs-toggle="modal" data-bs-target="#update-serial">${row.registered_equipments.equipment_serial_number}</a>`;
                        }
                    },
					{data: 'created_at',name:'created_at'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
							 let inspectionDate = row.equipment_inspection != '' ? row.equipment_inspection[0].created_at : 'No Maintenance Recorded';
                            return `<a href="https://dev.infiniguard.com/inspection-record">${inspectionDate}</a>`;
                        }
                    },
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);

	function showSerialNumbMatchMessage() {
		var serialNumber = $('#serial_number').val();
		var serialNumberConfirmation = $('#serial_number_confirmation').val();
		
		if (serialNumber != '' && serialNumber === serialNumberConfirmation) {
			$('#serial_numb_match_message').show();
			$('#serial_numb_match_message').text('Serial match!').addClass('text-success').removeClass('text-danger');
		} else {
			$('#serial_numb_match_message').show();
			$('#serial_numb_match_message').text('Serial Number does not match!').addClass('text-danger').removeClass('text-success');
		}
		
		
	}
	$('.modal').on('hidden.bs.modal', function(e) {
		$('#serial_numb_match_message').hide();
		$('#serial_numb_match_message').text('');
	});
	
	$('#serial_number, #serial_number_confirmation').on('input', function() {
		showSerialNumbMatchMessage();
	});

		$(document).on('click', '.update-serial', function(){
			let reg_equp_id=$(this).attr('data-id');

			$('#registered_equipment_id').val(reg_equp_id);
		})

		$(document).on('click', '#updateSerial', function(e) {
            e.preventDefault(); // Prevent default form submission
            var type=$(this).attr('data-curd');
            var formData = new FormData($('#updateSerialNumberForm')[0]);
            var url="";
           
                let id=$('#registered_equipment_id').val();
                url="{{ route('admin.registered-equipments.update', ':id') }}";
                 url = url.replace(':id', id);  

            $.ajax({
                type: 'POST',
                url: url, // Use the store route for creating new providers
                data: formData,
                processData: false,
                contentType: false,
                 beforeSend: function(xhr) {
					xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT'); // Set method override for Laravel (only for updating)
                    
                },
                success: function(response) {
                    $('#update-serial').modal('hide');              
                  if(response.status){
                     showAlert('success', response.message, null)    
                    }else{
                       showAlert('danger', response.message, null)
                    }                                           
                    $('#RegisteredQrCode').DataTable().ajax.reload();

                },
                error: function(xhr, status, error) {
                   if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;                        
                        showValidationErorrs(errors);
                    } else {
                        // Handle other types of errors
                       $('#update-serial').modal('hide');
                       showAlert('danger', xhr.responseJSON.message, null)
                        // You can display a generic error message here
                    }
                }
            });
        });
</script>
@endpush
