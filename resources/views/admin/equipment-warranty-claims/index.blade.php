@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

	<div class="modal fade" id="claimstatus">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Notes for INFINIGUARD® QR number 0000360</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Status</label>
							<select class="form-select form-control" aria-label="Default select example">
								<option selected>Answered</option>
								<option value="1">Unanswered</option>
							</select>
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Notes<span class="text-danger">*</span></label>
							<textarea class="form-control" id="" rows="3"></textarea>
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
		<h3 class="mb-0">Claims</h3>
		<div>
			<a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addOrderModalside">Add
				More</a>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 table-outer">
			<div class="table-responsive card-table rounded table-hover fs-14">
				<table class="table border-no display mb-4 dataTablesCard project-bx" id="EquipmentWarrantyClaim">
					<thead>
						<tr>
							<th> Customer Name </th>
							<th> Claim Status </th>
							<th> Customer Email </th>
							<th> Customer phone number </th>
							<th> QR number </th>
							<th> Certified Providers </th>
							<th> Certification ID </th>
							<th> Claim Date </th>
							<th>Maintenance History</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th> Customer Name </th>
							<th> Claim Status </th>
							<th> Customer Email </th>
							<th> Customer phone number </th>
							<th> QR number </th>
							<th> Certified Providers </th>
							<th> Certification ID </th>
							<th> Claim Date </th>
							<th>Maintenance History</th>
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
			let EquipmentWarrantyClaim = $('#EquipmentWarrantyClaim').DataTable({
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
                        url: "{!! route('admin.warranty-claims.index') !!}",
                        type: "GET",
						dataType: 'json',
                    },
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [7, 8] },
                    { searchable: false, "targets": [7, 8] },
                ],
                columns: [
                    {data: 'equipment_claim_name', name: 'equipment_claim_name'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let status = row.equipment_claim_status;
    						let equipment_claim_status = status == 1 ? 'answered' : 'unanswered';
    						let className = status == 1 ? ' btn-info' : 'btn-warning';
                            return `<a href="javascript:void(0)" class="btn ${className} d-block rounded" data-bs-toggle="modal" data-bs-target="#claimstatus">${equipment_claim_status}</a>`;
                        }
                    },					
                    {data: 'equipment_claim_email', name: 'equipment_claim_email'},
                    {data: 'equipment_claim_phone_number', name: 'equipment_claim_phone_number'},
                    {data: 'equipment_claim_qr_id', name: 'equipment_claim_qr_id'},
					{data: 'equipment_claim_id', name: 'equipment_claim_id'},
					{data: 'equipment_claim_id', name: 'equipment_claim_id'},
					{data: 'equipment_claim_date', name: 'equipment_claim_date'},
					{data: 'equipment_claim_id', name: 'equipment_claim_id'},
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);
</script>
@endpush