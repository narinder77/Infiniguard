@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!--Main-Content-->
	
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Profile</h3>
		
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="clearfix">
				<div class="card card-bx author-profile m-b30">
					<div class="card-body">
						<div class="p-3">
							<div class="author-profile">
								<div class="author-media">
									<img src="{{ asset('images/profile.jpg')}}" alt="">
									<div class="upload-link" title="" data-bs-toggle="tooltip" data-placement="right" data-original-title="update">
										<input type="file" class="update-flie">
										<i class="fa fa-camera"></i>
									</div>
								</div>
								<div class="author-info">
									<h3 class="title">INFINIGUARD® GLOBAL</h3>
									<p><a href="">maintenance@infiniguard.com</a></p>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8">
			<div class="card  card-bx m-b30">
				<div class="card-header">
					<h2 class="title">Account setup</h2>
				</div>
				<form class="profile-form">
					@csrf
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 m-b30">
								<label class="form-label">Company Name<span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="John">
							</div>
							<div class="col-sm-6 m-b30">
								<label class="form-label">Company Administrator</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-sm-6 m-b30">
								<label class="form-label">Email Address</label>
								<input type="text" class="form-control" value="Developer">
							</div>
							<div class="col-sm-6 m-b30">
								<label class="form-label">Phone Number<span class="text-danger">*</span></label>
								<input type="number" class="form-control" value="">
							</div>
							<div class="col-sm-12 m-b30">
								<label class="form-label">Company Logo</label>
								<div class="mb-0">
									<input class="form-control" type="file" id="formFile" onchange="preview()">
									<!--<button onclick="clearImage()" class="btn btn-primary mt-3">Click me</button>-->
								</div>
								<img id="frame" src="" class="img-fluid" />
							</div>
							
						</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-primary">UPDATE PROFILE</button>
						<a href="{{ url('page-forgot-password')}}" class="text-primary btn-link">Forgot your password?</a>
					</div>
				</form>
			</div>
		</div>
	</div>	

</div>

<script>
            function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
            function clearImage() {
                document.getElementById('formFile').value = null;
                frame.src = "";
            }
        </script>

@endsection