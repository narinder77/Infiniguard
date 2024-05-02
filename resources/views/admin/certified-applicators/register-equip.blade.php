@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Registered Equipment by {{$certifiedApplicator->applicator_name ?? ''}} of {{$certifiedApplicator->certifiedProviders->provider_name ?? ''}}</h3>
        <input type="hidden" id="applicatorId" value="{{ $certifiedApplicatorId}}">
		
	</div>
	<div class="row">
		<div class="col-lg-12 table-outer">
			<div class="table-responsive card-table rounded table-hover fs-14">
				<table class="table border-no display mb-4 dataTablesCard project-bx" id="RegisteredEqup">
					<thead>
						<tr>						
							<th class="text-start"> QR Number </th>
							<th> Application Date </th>
                            <th> Clients </th>
							<th> Last Maintenance Date </th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<thead>
						<tr>
							<th> QR Number </th>
							<th> Application Date </th>
                            <th> Clients </th>
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
        var applicatorId = $('#applicatorId').val();
        if (applicatorId) {
            var url = "{{ route('admin.applicator.registerEquip', ':id') }}";
             url = url.replace(':id', applicatorId);
			let RegisteredEqup = $('#RegisteredEqup').DataTable({
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
                        url: url,
                        type: "GET",
						dataType: 'json',
                    },
                order: [[3, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [2,3 ] },
                    { searchable: false, "targets": [2,3] },
                ],
                columns: [
                    {data: 'registered_equipments.equipment_qr_number', name: 'equipment_qr_number'},
                    {data: 'created_at',name:'created_at'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">client</a>`;
                        }
                    },                  
					
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            let inspectionDate = row.equipment_inspection ? row.equipment_inspection.created_at : 'No Maintenance Recorded';
                            return `<a href="https://dev.infiniguard.com/inspection-record">${inspectionDate}</a>`;
                        }
                    },
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
         } else {
        console.error("applicatorId is empty. DataTable initialization skipped.");
            }
        })(jQuery);
</script>
@endpush
