@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

	<!-- Add Order -->
	<div class="modal fade" id="add-more">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Certified Applicator</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Certification ID<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Company</label>
							<select class="form-select form-control" aria-label="Default select example">
								<option selected>Open this select menu</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Email<span class="text-danger">*</span></label>
							<input type="email" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Password<span class="text-danger">*</span></label>
							<input type="password" class="form-control">
						</div>

						<div class="form-group">
							<label class="text-black font-w500">Certification Date<span
									class="text-danger">*</span></label>
							<input type="date" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary">SUBMIT</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Edit Table -->
	<div class="modal fade" id="edit-profile">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Certified Applicator</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Certification ID<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Company</label>
							<select class="form-select form-control" aria-label="Default select example">
								<option selected>Open this select menu</option>
								<option value="1">One</option>
								<option value="2">Two</option>
								<option value="3">Three</option>
							</select>
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Email<span class="text-danger">*</span></label>
							<input type="email" class="form-control">
						</div>

						<div class="form-group">
							<label class="text-black font-w500">Certification Date<span
									class="text-danger">*</span></label>
							<input type="date" class="form-control">
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
		<h3 class="mb-0">INFINIGUARD Certified Applicators</h3>
		<div>
			<a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#add-more">Add More</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 table-outer">
			<div class="table-responsive card-table rounded table-hover fs-14">
				<table class="table border-no display mb-4 dataTablesCard project-bx" id="CertifiedApplicator">
					<thead>
						<tr>
							<th> Certification ID </th>
							<th> Name </th>
							<th> Certified Providers</th>
							<th> Email </th>
							<th> Certification Date </th>
							<th> Completed Applications </th>
							<th> Warranty Claims </th>
							<th> Certification Status </th>
							<th> Edit </th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<thead>
						<tr>
							<th> Certification ID </th>
							<th> Name </th>
							<th> Certified Providers</th>
							<th> Email </th>
							<th> Certification Date </th>
							<th> Completed Applications </th>
							<th> Warranty Claims </th>
							<th> Certification Status </th>
							<th> Edit </th>
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
			let CertifiedApplicator = $('#CertifiedApplicator').DataTable({
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
                        url: "{!! route('admin.applicators.index') !!}",
                        type: "GET",
						dataType: 'json',
                    },
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [5, 6, 7, 8] },
                    { searchable: false, "targets": [5, 6, 7, 8] },
                ],
                columns: [
                    {data: 'applicator_certification_id', name: 'applicator_certification_id'},
                    {data: 'applicator_name', name: 'applicator_name'},
                    {data: 'certified_providers.provider_name', name: 'provider_name'},
                    {data: 'applicator_email', name: 'applicator_email'},
					{data: 'applicator_date', name: 'applicator_date'},
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">${row.registered_codes_count}</a>`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            let applicator_id = row.applicator_id;
                            let baseUrl = "{{ route('admin.applicators.show', '') }}";
                            return `<a href="${baseUrl}/${applicator_id}" class="">${row.warranty_claims_count}</a>`;
                        }
                    },
					{
                        data: null,
                        render: function (data, type, row, meta) {
                            let status = row.applicator_status;
    						let checkedAttribute = status == 1 ? 'checked' : '';
                            return `<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" id="certificationStatus" name="" value="yes" ${checkedAttribute}>
									</div>`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
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
                                        <a class="dropdown-item" href="${baseUrl}/${applicator_id}">Delete</a>
                                    </div>
                                </div>`;
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
