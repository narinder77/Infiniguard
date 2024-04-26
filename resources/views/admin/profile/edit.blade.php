@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!--Main-Content-->
	
	<div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
		<h3 class="mb-0">Edit Profile</h3>
		<a data-bs-toggle="modal" data-id="{{ $certifiedProvider->provider_id }}" data-bs-target="#change-password" href="javascript:void(0)" class="btn btn-primary rounded mx-2" id="change-pass">Change Password</a>

		
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
									<img src="{{ asset('storage/'.$certifiedProvider->provider_profile_image) }}" alt="">
									{{-- <div class="upload-link" title="" data-bs-toggle="tooltip" data-placement="right" data-original-title="update">
										<input type="file" class="update-flie">
										<i class="fa fa-camera"></i>
									</div> --}}
								</div>
								<div class="author-info">
									<h3 class="title">{{$certifiedProvider->provider_name}}</h3>
									<p><a href="">{{$certifiedProvider->provider_email}}</a></p>
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
				 <form id="providerForm" enctype="multipart/form-data">
					@csrf
					<input type="hidden" id="certifiedProviderId" value="{{$certifiedProvider->provider_id}}" name="certifiedProviderId" class="form-control">

					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 mb-4">
							     <label class="text-black font-w500">Certified Provider Administrator</label>
                            	<input type="text" placeholder="Enter Certified Provider Administrator" value="{{$certifiedProvider->provider_administrator}}" id="providerAdministrator" name="providerAdministrator" class="form-control">
                        	</div>
							<div class="col-sm-6 mb-4">
							    <label class="text-black font-w500">Certified Provider Name<span class="text-danger">*</span></label>
                          		<input type="text" placeholder="Enter Certified Provider Name" value="{{$certifiedProvider->provider_name}}" id="providerName" name="providerName" class="form-control">
                        	</div>
							<div class="col-sm-6 mb-4">
							    <label class="text-black font-w500">Email<span class="text-danger">*</span></label>
                          		<input type="email" placeholder="Enter Email" value="{{$certifiedProvider->provider_email}}" id="providerEmail" name="providerEmail" class="form-control">
                        	</div>							
							<div class="col-sm-6 mb-4">
							    <label class="text-black font-w500">Phone<span class="text-danger">*</span></label>
                            	<input type="tel" placeholder="Enter Phone" value="{{$certifiedProvider->provider_phone}}" id="providerPhone" name="providerPhone" class="form-control">
                        	</div>
							<div class="col-sm-12 mb-4">
							    <label class="text-black font-w500">Certified Provider Logo<span class="text-danger">*</span></label>
                           		<input class="form-control" name="providerLogo" type="file" id="company-logo">
                        	</div>
							<div class="col-6" id="logo">
                            <div class="card">
                                <div class="card-body text-center">  
                                <img src="{{ asset('storage/'.$certifiedProvider->provider_logo_image) }}" class="img-fluid" id="logo-img" style="width:100px;height:auto;" alt="">
                                </div>
								</div>
                        	</div>
							<div class="col-sm-12 mb-4">
							     <label class="text-black font-w500">Profile Image<span class="text-danger">*</span></label>                            
                          		 <input class="form-control" name="providerImage"  type="file" id="profile-image">
                        	</div>
							<div class="col-6" id="profile-card">
                            <div class="card">
                                <div class="card-body text-center">  
                                <img src="{{ asset('storage/'.$certifiedProvider->provider_profile_image) }}" class="img-fluid" id="profile-img" style="width:100px;height:auto;" alt="">
                                </div>
                            </div>
                        </div>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" id="submitBtn" class="btn btn-primary">UPDATE PROFILE</button>
						{{-- <a href="{{ url('page-forgot-password')}}" class="text-primary btn-link">Forgot your password?</a> --}}
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="change-password">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Reset Your Password</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
				<form id="resetPassForm">
					@csrf
					<input type="hidden" id="providerId" name="providerId" value="">
					{{-- <div>
						<label for="current_password">Current Password<span class="text-danger">*</span></label>
						<input id="current_password" type="password" name="current_password">
					</div> --}}
					<div class="form-group">
						<label class="text-black font-w500">Password<span class="text-danger">*</span></label>
						<input type="password" placeholder="Enter Password" id="new_password" name="new_password" class="form-control">
					</div>
					<div class="form-group">
						<label class="text-black font-w500">Confirm Password<span class="text-danger">*</span></label>
						<input type="password" placeholder="Enter Confirm Password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
					<div id="password_match_message"></div>

					</div>

					<button type="button" id="updatePassBtn" class="btn btn-primary">Submit</button>
				</form>
            </div>           
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
	function preview() {
		frame.src = URL.createObjectURL(event.target.files[0]);
	}
	function clearImage() {
		document.getElementById('formFile').value = null;
		frame.src = "";
	}

	function showValidationErorrs(errors){

		$('.is-invalid').removeClass('is-invalid');
		$('.invalid-feedback').remove();
		$.each(errors, function(key, value) {
			var field = $('[name="' + key + '"]');
			field.addClass('is-invalid');
			field.after('<div class="invalid-feedback">' + value[0] + '</div>');

				field.focus(function() {
			$(this).removeClass('is-invalid');
			$(this).next('.invalid-feedback').remove();
		});
		});          

	}

	function resetForm() {
		$('#resetPassForm')[0].reset();
		
		$('.is-invalid').removeClass('is-invalid');
		$('.invalid-feedback').remove();
		$('#password_match_message').hide();
	}

	function showPasswordMatchMessage() {
		var newPassword = $('#new_password').val();
		var confirmPassword = $('#new_password_confirmation').val();

		if (newPassword === confirmPassword) {
			$('#password_match_message').show();
			$('#password_match_message').text('Passwords match').addClass('text-success').removeClass('text-danger');
		} else {
			$('#password_match_message').show();
			$('#password_match_message').text('Passwords do not match').addClass('text-danger').removeClass('text-success');
		}
	}

	$('#new_password, #new_password_confirmation').on('input', function() {
		showPasswordMatchMessage();
	});


	$('#change-password').on('hidden.bs.modal', function (e) {
		resetForm();
	});

	$(document).on('click', '#submitBtn', function(e) {
		e.preventDefault(); // Prevent default form submission

		var formData = new FormData($('#providerForm')[0]);
  		let providerId= $('#certifiedProviderId').val();
		let url="{{ route('admin.providers.update', ':id') }}";
			url = url.replace(':id', providerId);

		$.ajax({
			type: 'POST',
			url: url , // Use the store route for creating new providers
			data: formData,
			processData: false,
			contentType: false,
			 beforeSend: function(xhr) {
				xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT'); // Set method override for Laravel (only for updating)
                    
			},
			success: function(response) {				

				if(response.status){
					$('#successAlert').addClass('alert-success'); 
					$('#successAlert').removeClass('alert-danger');      
				}else{
					$('#successAlert').removeClass('alert-success'); 
					$('#successAlert').addClass('alert-danger');     
				}
				$('#successAlert').fadeIn();
				$('#successAlert').text(response.message);

					// Hide alert after 10 seconds (10000 milliseconds)
					setTimeout(function() {
						$('#successAlert').fadeOut();
					}, 10000);	
				//window.location.href="{{route('admin.providers.index')}}"   			

			},
			error: function(xhr, status, error) {
				if (xhr.responseJSON && xhr.responseJSON.errors) {
					var errors = xhr.responseJSON.errors;                        
					showValidationErorrs(errors);
				} else {
					// Handle other types of errors
					console.error(xhr.responseText);
					// You can display a generic error message here
				}
			}
		});
	});

	$(document).on('click','#updatePassBtn',function(e){
		e.preventDefault();

		    var formData = new FormData($('#resetPassForm')[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.profile.update') }}", // Use the store route for creating new providers
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
					$('#change-password').modal('hide');
					resetForm();         
                    if(response.status){
                        $('#successAlert').addClass('alert-success'); 
                        $('#successAlert').removeClass('alert-danger');      
                    }else{
                        $('#successAlert').removeClass('alert-success'); 
                        $('#successAlert').addClass('alert-danger');     
                    }
                    $('#successAlert').fadeIn();
                    $('#successAlert').text(response.message);

                        // Hide alert after 10 seconds (10000 milliseconds)
                        setTimeout(function() {
                            $('#successAlert').fadeOut();
                        }, 10000);
                    $('#CertifiedProvider').DataTable().ajax.reload();

                },
                error: function(xhr, status, error) {
                   if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;                        
                        showValidationErorrs(errors);
                    } else {
                        // Handle other types of errors
                        console.error(xhr.responseText);
                        // You can display a generic error message here
                    }
                }
            });


	})

	$(document).on('click','#change-pass',function(e){
		e.preventDefault();
		let id =$(this).data('id');
		$('#providerId').val(id);

	})
</script>
@endpush

