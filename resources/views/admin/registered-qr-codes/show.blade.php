@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
	<!-- Add Order -->
	<div class="modal fade" id="client-qr-info">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Client information for INFINIGUARD® QR number 0000316</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Client<span class="text-danger">*</span></label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Maintenance Reminder<span class="text-danger">*</span></label>
							<div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="reminder-yes" value="option1">
									<label class="form-check-label" for="reminder-yes">Yes</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="reminder-no" value="option2">
									<label class="form-check-label" for="reminder-no">No</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Days until maintenance reminder</label>
							<input type="number" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Reminder Language<span class="text-danger">*</span></label>
							<select class="form-select form-control" aria-label="Default select example">
								<option selected>English</option>
								<option value="1">Spanish</option>
							</select>
						</div>
						<div class="form-group">
							<div class="d-flex justify-content-between align-item-center mb-3">
								<label class="text-black font-w500 mb-0 mt-2">Additional Contact Info<span class="text-danger">*</span></label>
								<a class="add btn btn-primary" href="#"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6 8H0V6H6V0H8V6H14V8H8V14H6V8Z" fill="#fff"/>
								</svg>Add</a>	
							</div>
							
							<div id="select" class="row input">
								<div class="col-sm-6">
									<input type="text" class="form-control" placeholder="Contact Name">
								</div>
								<div class="col-sm-6">
									<input type="email" class="form-control" placeholder="Email">
								</div>
								<!--<a class="delete" href="#">Remove</a>-->
							</div>
							<div id="additionalselects">
							</div>
							
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
		<h3 class="mb-0">Client information for QR number</h3>
		
	</div>
	<div class="row">
		<div class="col-lg-12 table-outer">
		<div class="table-responsive card-table rounded table-hover fs-14">
						<table class="table border-no display mb-4 dataTablesCard project-bx" id="example5">
							<thead>
								<tr>
									<th>
									QR Number
									</th>
									<th>
									Application Date
									</th>
									<th>
									Client  
									</th>
									<th>
									Last Maintenance Date
									</th>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
									0000316
									</td>
									<td>
									08-22-2019 11:13 AM
									</td>
									<td>
									<a href="{{ url('qr-client-information')}}">Client</a>
									</td>
									<td>
									<a href="{{ url('inspection-record')}}">No Maintenance Recorded</a>
									</td>
								</tr>
								<tr>
									<td>
									0000316
									</td>
									<td>
									08-22-2019 11:13 AM
									</td>
									<td>
									<a  href="{{ url('qr-client-information')}}">Client</a>
									</td>
									<td>
									<a href="{{ url('inspection-record')}}">No Maintenance Recorded</a>
									</td>
								</tr>
								<tr>
									<td>
									0000316
									</td>
									<td>
									08-22-2019 11:13 AM
									</td>
									<td>
									<a href="{{ url('qr-client-information')}}">Client</a>
									</td>
									<td>
									<a href="{{ url('inspection-record')}}">No Maintenance Recorded</a>
									</td>
								</tr>
								<tr>
									<td>
									0000316
									</td>
									<td>
									08-22-2019 11:13 AM
									</td>
									<td>
									<a href="{{ url('qr-client-information')}}">Client</a>
									</td>
									<td>
									<a href="{{ url('inspection-record')}}">No Maintenance Recorded</a>
									</td>
								</tr>
								<tr>
									<td>
									0000316
									</td>
									<td>
									08-22-2019 11:13 AM
									</td>
									<td>
									<a  href="{{ url('qr-client-information')}}">Client</a>
									</td>
									<td>
									<a href="{{ url('inspection-record')}}">No Maintenance Recorded</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
	(function($) {
	 
		var table = $('#example5').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example6').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example7').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example8').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		$('#example tbody').on('click', 'tr', function () {
			var data = table.row( this ).data();
			
		});
	   
	})(jQuery);
</script>
<script>
	jQuery(function($){
    $(".add").click(function() {
        $("#select").clone()
            .removeAttr("id")
            .append( $('<a class="delete btn" href="#">Remove</a>') )
            .appendTo("#additionalselects");
    });
    $("body").on('click',".delete", function() {
        $(this).closest(".input").remove();
    });
})(jQuery);
	</script>

@endpush