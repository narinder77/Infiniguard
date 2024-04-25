@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Warranty Claims for {{$certifiedApplicator->applicator_name ?? ''}} of {{$certifiedApplicator->certifiedProviders->provider_name ?? ''}}</h3>
        <input type="hidden" id="applicatorId" value="{{ $certifiedApplicatorId}}">
		
	</div>
	<div class="row">
		<div class="col-lg-12 table-outer">
			<div class="table-responsive card-table rounded table-hover fs-14">
				<table class="table border-no display mb-4 dataTablesCard project-bx" id="applicatorWarrantyClaim">
					<thead>
						<tr>						
							<th> Customer Name </th>
							<th> Status </th>
							<th> Customer Email </th>
							<th> Customer phone number </th>
							<th> QR number </th>
                            <th> Company Name </th>
							<th> Certification ID </th>
							<th> Date </th>
							<th> Inspection History</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<thead>
						<tr>
							<th> Customer Name </th>
							<th> Status </th>
							<th> Customer Email </th>
							<th> Customer phone number </th>
							<th> QR number </th>
                            <th> Company Name </th>
							<th> Certification ID </th>
							<th> Date </th>
							<th> Inspection History</th>
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
            var url = "{{ route('admin.applicator.warranty-claims', ':id') }}";
             url = url.replace(':id', applicatorId);
			let applicatorWarrantyClaim = $('#applicatorWarrantyClaim').DataTable({
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
                    { orderable: false, "targets": [1,8 ] },
                    { searchable: false, "targets": [1,8] },
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
                    {data: 'qr_code.equipment_qr_number', name: 'equipment_claim_qr_id'},
                    {data: 'certified_applicators.certified_providers.provider_name', name: 'provider_name'},
                    {data: 'certified_applicators.applicator_certification_id', name: 'applicator_certification_id'},
					{data: 'equipment_claim_date', name: 'equipment_claim_date'},
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let certified_applicators = row.certified_applicators;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="${baseUrl}/${certified_applicators}" class="">View maintenance history</a>`;
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
