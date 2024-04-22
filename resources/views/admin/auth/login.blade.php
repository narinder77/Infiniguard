@extends('admin.layouts.guest')

@section('content')
<div class="col-xl-12">
	<div class="card">
		<div class="card-body p-0">
			<div class="row m-0">
				<div class="col-xl-6 col-md-6 login-img-box text-center">
					<img src="./images/logo.svg" class="logo" alt="" />
					<div class="login-btns">
						<a href="#">
							<div class="box active">
								<h3>Client Login</h3>
							</div>
						</a>
						<a href="#">
							<div class="box">
								<h3>Certified Provider Login</h3>
							</div>
						</a>
					</div>
					<div class="play-logo">
						<div class="img-box">
							<img src="{{ asset('assets/images/apple.png') }}" alt="" />
						</div>
						<div class="img-box">
							<img src="{{ asset('assets/images/apple.png') }}" alt="" />
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-md-6">
					<div class="sign-in-your">
						<h2>Customer Login</h2>
						@if(Session::has('error'))
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-ban"></i> {{ Session::get('error') }}</h5>
						</div>
						@endif
						@if(Session::has('message'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h5><i class="icon fas fa-check"></i> Alert!</h5>
						</div>
						@endif
						<form method="POST" action="{{ route('admin.login') }}">
							@csrf
							<div class="mb-3">
								<label class="mb-1"><strong>Email</strong></label>
								<input type="email" name="email" class="form-control" value="{{old('email')}}">
								@error('email')
								<div class="invalid-feedback d-block">{{ $message }}</div>
								@enderror								
							</div>
							<div class="mb-3">
								<label class="mb-1"><strong>Password</strong></label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="row d-flex justify-content-between mt-4 mb-2">
								<div class="mb-3">
									<div class="form-check custom-checkbox ms-1">
										<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
										<label class="form-check-label" for="basic_checkbox_1">Remember me</label>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary btn-block w-100">SUBMIT</button>
								<a href="{{ route('admin.forgot-password')}}" class="text-btn">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p>Copyright © 2024 INFINIGUARD Global, Inc. All rights reserved.</p>
</div>
@endsection