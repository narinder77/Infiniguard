@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
<!--Main-Content-->
	
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Change Password</h3>
	
	</div>
    <div class="row">
        <div class="col-lg-12">
		<div class="card  card-bx m-b30">
				
				<form class="profile-form">
					@csrf
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12 m-b30" id="">
								<label class="form-label">New Password</label>
								<input type="password" class="form-control" value="">
							</div>
							<div class="col-sm-12 m-b30" id="">
								<label class="form-label">Confirm Password</label>
								<input type="password" class="form-control" value="">
							</div>
						</div>	
						<a class="btn btn-primary">UPDATE PASSWORD</a>
						</div>
						
					</div>
					
				</form>
			</div>
        </div>
    </div>
    </div>
</div>

@endsection