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
					<form>
						<div class="form-group">
							<label class="text-black font-w500">Serial Number<span class="text-danger">*</span></label>
							<input type="number" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Confirm Serial Number<span
									class="text-danger">*</span></label>
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
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Registered Equipments</h3>
		<div>
			<a href="#" class="btn btn-primary rounded">Download Data Into Spreadsheet</a>
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
                    { orderable: false, "targets": [5, 6 ] },
                    { searchable: false, "targets": [5, 6] },
                ],
                columns: [
					{data: 'certified_providers.provider_name',name: 'certified_providers.provider_name'},
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
                        data: null,
                        name: 'registered_equipments.equipment_serial_number',
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="javascript:void(0)" class="btn btn-info d-block rounded" data-bs-toggle="modal" data-bs-target="#update-serial">${row.registered_equipments.equipment_serial_number}</a>`;
                        }
                    },
					{data: 'created_at',name:'created_at'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="https://dev.infiniguard.com/inspection-record">No Maintenance Recorded</a>`;
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
