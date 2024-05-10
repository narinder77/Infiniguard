@extends('admin.layouts.app')
<style>
		/**
 * EasyZoom core styles
 */
.easyzoom {
	position: relative;

	/* 'Shrink-wrap' the element */
	display: inline-block;
	*display: inline;
	*zoom: 1;
}

.easyzoom img {
	vertical-align: bottom;
}

.easyzoom.is-loading img {
	cursor: progress;
}

.easyzoom.is-ready img {
	cursor: crosshair;
}

.easyzoom.is-error  img {
	cursor: not-allowed;
}

.easyzoom-notice {
	position: absolute;
	top: 50%;
	left: 50%;
	z-index: 150;
	width: 10em;
	margin: -1em 0 0 -5em;
	line-height: 2em;
	text-align: center;
	background: #FFF;
	box-shadow: 0 0 10px #888;
}

.easyzoom-flyout {
	position:absolute;
	z-index: 100;
	overflow: hidden;
	background: #FFF;
}

/**
 * EasyZoom layout variations
 */
.easyzoom--overlay .easyzoom-flyout {
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.easyzoom--adjacent .easyzoom-flyout {
	top: 0;
	left: 100%;
	width: 100%;
	height: 100%;
	margin-left: 20px;
}
.thumbnails {
	overflow: hidden;
	margin: 1em 0;
	padding: 0;
	text-align: center;
}

.thumbnails li {
	display: inline-block;
	width: 140px;
	margin: 0 5px;
}

.thumbnails img {
	display: block;
	min-width: 100%;
	max-width: 100%;
}
</style>
@section('content')
	<div class="modal fade" id="update-serial">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Serial Number</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="updateSerialNumberForm">
						<div class="form-group">
							<label class="text-black font-w500">Serial Number<span class="text-danger">*</span></label>
							<input name="registered_equipment_id" id="registered_equipment_id" type="hidden" class="form-control">

							<input name="serial_number" id="serial_number" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Confirm Serial Number<span
									class="text-danger">*</span></label>
							<input name="serial_number_confirmation" id="serial_number_confirmation" type="text" class="form-control">
						<div id="serial_numb_match_message"></div>
						</div>
						<div class="form-group">
							<button type="button" id="updateSerial" class="btn btn-primary">SUBMIT</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
    <div class="container-fluid">
        <div class="heading-part d-lg-flex d-block mb-3 pb-3 border-bottom justify-content-between align-items-center">
            <h3 class="mb-0">{{$title}}</h3>
            <div>
                <a href="javascript:void(0)" data-id="{{$register_qr->registeredEquipments->equipment_qr_id}}" class="btn btn-primary rounded update-serial" data-bs-toggle="modal" data-bs-target="#update-serial">{{$register_qr->registeredEquipments->equipment_serial_number}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 "> 
            <div class="card">
               <div class="card-body">   
                <div class="row">
                @if($register_qr->model_number_image)             
                <div class="col-6">
                    <div style="float: right; width: 310px; height: 400px; background: #EEE;"></div>
                    <div class="easyzoom easyzoom--adjacent">
                        <a href="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}">
                            <img src="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}" alt="" width="310" height="400" />
                        </a>
                    </div>
                </div>
                 @endif
                @if($register_qr->serial_number_image)
                <div class="col-6">
                    <div style="float: right; width: 310px; height: 400px; background: #EEE;"></div>
                    <div class="easyzoom easyzoom--adjacent">
                        <a href="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}">
                            <img src="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}" alt="" width="310" height="400" />
                        </a>
                    </div>
                </div>
                @endif
                @if($register_qr->distant_image) 
                <div class="col-6">
                    <div style="float: right; width: 310px; height: 400px; background: #EEE;"></div>
                    <div class="easyzoom easyzoom--adjacent">
                        <a href="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}">
                            <img src="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}" alt="" width="310" height="400" />
                        </a>
                    </div>
                </div>
                @endif
                 @if($register_qr->additional_image && ($additionalImages = json_decode($register_qr->additional_image)))
                    @foreach($additionalImages as $image)
                        @if($image)
                        <div class="col-6">
                            <div style="float: right; width: 310px; height: 400px; background: #EEE;"></div>
                            <div class="easyzoom easyzoom--adjacent">
                                <a href="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}">
                                    <img src="{{asset('assets/images/inspection-pictures/1546344124_condenser_coil1.jpg') }}" alt="" width="310" height="400" />
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                </div></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src='{{ asset('assets/js/easyzoom.js') }}'></script>
    <script>
    $(document).ready(function() {      

        $(document).on('click', '.update-serial', function(){
                let reg_equp_id=$(this).attr('data-id');

                $('#registered_equipment_id').val(reg_equp_id);
            })

            $(document).on('click', '#updateSerial', function(e) {
                e.preventDefault(); // Prevent default form submission
                var type=$(this).attr('data-curd');
                var formData = new FormData($('#updateSerialNumberForm')[0]);
                var url="";
            
                    let id=$('#registered_equipment_id').val();
                    url="{{ route('admin.registered-equipments.update', ':id') }}";
                    url = url.replace(':id', id);  

                $.ajax({
                    type: 'POST',
                    url: url, // Use the store route for creating new providers
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT'); // Set method override for Laravel (only for updating)
                        
                    },
                    success: function(response) {
                        $('#update-serial').modal('hide');              
                    if(response.status){
                        showAlert('success', response.message, null)    
                        }else{
                        showAlert('danger', response.message, null)
                        }                                           
                        $('#RegisteredQrCode').DataTable().ajax.reload();

                    },
                    error: function(xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;                        
                            showValidationErorrs(errors);
                        } else {
                            // Handle other types of errors
                        $('#update-serial').modal('hide');
                        showAlert('danger', xhr.responseJSON.message, null)
                            // You can display a generic error message here
                        }
                    }
                });
            });

        function showSerialNumbMatchMessage() {
            var serialNumber = $('#serial_number').val();
            var serialNumberConfirmation = $('#serial_number_confirmation').val();
            
            if (serialNumber != '' && serialNumber === serialNumberConfirmation) {
                $('#serial_numb_match_message').show();
                $('#serial_numb_match_message').text('Serial match!').addClass('text-success').removeClass('text-danger');
            } else {
                $('#serial_numb_match_message').show();
                $('#serial_numb_match_message').text('Serial Number does not match!').addClass('text-danger').removeClass('text-success');
            }
            
            
        }
        $('.modal').on('hidden.bs.modal', function(e) {
            $('#serial_numb_match_message').hide();
            $('#serial_numb_match_message').text('');
        });
        
        $('#serial_number, #serial_number_confirmation').on('input', function() {
            showSerialNumbMatchMessage();
        });

    /* $('#zoom_01').elevateZoom({
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750
        });  */
    var $easyzoom = $('.easyzoom').easyZoom({
        zoomWindowWidth: 800, // Increase the zoom window width
        zoomWindowHeight: 800 // Increase the zoom window height
    });
    var api = $easyzoom.data('easyZoom');
    $('.easyzoom').on('mouseenter', function() {
      
        $(window).on('scroll', function() {
            var scrollPercentage = ($(this).scrollTop() / ($(document).height() - $(window).height())) * 100;
            var maxZoomLevel = 2; // Maximum zoom level
            var minZoomLevel = 1; // Minimum zoom level
        
            // Adjust zoom level based on scroll percentage
            var zoomLevel = minZoomLevel + ((maxZoomLevel - minZoomLevel) * (scrollPercentage / 100));
            console.log(zoomLevel);
            // Set zoom level if opts exist
          if (api && api.opts) {
                api.opts.zoomLevel = zoomLevel;
            }
        });
    }).on('mouseleave', function() {
        $(window).off('scroll'); // Unbind scroll event when mouse leaves
    });

    }); 
    </script>
@endpush
