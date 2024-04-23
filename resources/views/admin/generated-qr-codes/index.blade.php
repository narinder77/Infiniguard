@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
	<!-- Add Order -->
	<div class="modal fade" id="addOrderModalside">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Generate INFINIGUARD® QR Codes</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Number of QR codes to generate<span class="text-danger">*</span></label>
							<select class="form-select form-control" aria-label="Default select example">
							<option selected>Armor Coat</option>
							<option value="1">Armor Coat</option>
							<option value="2">Armor Coat</option>
							<option value="3">Armor Coat</option>
							</select>
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Starting QR Number<span class="text-danger">*</span></label>
							<input type="number" class="form-control">
						</div>

						<div class="form-group">
							<button type="button" class="btn btn-primary">SUBMIT</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--Main-Content-->
	
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Generated QR Codes</h3>
		<div>
			<a href="#" class="btn btn-primary rounded">Download QR Codes into spreadsheet</a>
			<a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addOrderModalside">Generate New QR Codes</a>

		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 table-outer">
			<div class="table-responsive card-table rounded table-hover fs-14">
				<table class="table border-no display mb-4 dataTablesCard project-bx" id="GeneratedQrCodes">
					<thead>
						<tr>
							<th>Qr number</th>
							<th>Status</th>
							<th>Code Information</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<thead>
						<tr>
							<th>Qr number</th>
							<th>Status</th>
							<th>Code Information</th>
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
			let CertifiedApplicator = $('#GeneratedQrCodes').DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    }
                },  
                "pagingType": "simple_numbers",
                "lengthMenu": [ 5, 10, 25, 50, 100],
                "pageLength": 10,              
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: '{!! route('admin.generated-qr-codes.index') !!}',
				columnDefs: [
                    { orderable: false, "targets": [1,2] },
                    { searchable: false, "targets": [1,2] },
                ],
                columns: [
                    {data: 'equipment_qr_number', name: 'equipment_qr_number'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
							let status = row.registered_codes;
    						let equipment_claim_status = status !='' ? 'Registered' : 'Unregistered';
                            return `${equipment_claim_status}`;
                        }
                    },					
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            return `${row.equipment_model_number}, qr_number:${row.equipment_qr_number}, company:infiniguard`;
                        }
                    },
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);
</script>
@endpush