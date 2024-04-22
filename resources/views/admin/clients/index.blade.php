@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
	<!-- Add Order -->
	<div class="modal fade" id="addOrderModalside">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add INFINIGUARD Client</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Company Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client First Name<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Last Name<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Phone Number<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>

						<div class="form-group">
							<label class="text-black font-w500">Client Email<span class="text-danger">*</span></label>
							<input type="email" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Provider<span
									class="text-danger">*</span></label>
							<select class="form-select form-control" aria-label="Default select example">
								<option selected>Armor Coat</option>
								<option value="1">Armor Coat</option>
								<option value="2">Armor Coat</option>
								<option value="3">Armor Coat</option>
							</select>
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Password<span
									class="text-danger">*</span></label>
							<input type="password" class="form-control">
						</div>

						<div class="form-group">
							<button type="button" class="btn btn-primary">SUBMIT</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Edit modal -->
	<div class="modal fade" id="edit-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Profile</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Company <span class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client First Name<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Last Name<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Phone Number<span
									class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>

						<div class="form-group">
							<label class="text-black font-w500">Client Email<span class="text-danger">*</span></label>
							<input type="email" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Provider<span
									class="text-danger">*</span></label>
							<select class="form-select form-control" aria-label="Default select example">
								<option selected>Armor Coat</option>
								<option value="1">Armor Coat</option>
								<option value="2">Armor Coat</option>
								<option value="3">Armor Coat</option>
							</select>
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
			<a href="#" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addOrderModalside">Add
				More</a>
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
			let clients = $('#clients').DataTable({
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
                        url: "{!! route('admin.clents.index') !!}",
                        type: "GET",
						dataType: 'json',
                    },
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, "targets": [5, 6, 7] },
                    { searchable: false, "targets": [5, 6, 7] },
                ],
                columns: [				
                    {data: 'client_id', name: 'client_id'},
                    {data: 'client_company_name', name: 'client_company_name'},
                    {data: 'client_firstname', name: 'client_firstname'},
                    {data: 'client_email', name: 'client_email'},
					{data: 'client_phone', name: 'client_phone	'},
					{data: 'client_provider_id', name: 'client_provider_id'},
					{data: 'client_id', name: 'client_id'},
					{data: 'client_id', name: 'client_id'}
                ]
            });
            $('#example tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
            });
        })(jQuery);
</script>
@endpush