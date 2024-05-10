@php
    $controller = DzHelper::controller();
    $page = $action = DzHelper::action();
    $action = $controller.'_'.$action;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- PAGE TITLE HERE -->
	<title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="@yield('page_description', $page_description ?? '')"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Vora : Crypto Trading UI Admin  Bootstrap 5 Template" />
	<meta property="og:title" content="Vora : Crypto Trading UI Admin Bootstrap 5 & Laravel Template" />
	<meta property="og:description" content="{{ config('dz.name') }} | @yield('title', $page_title ?? '')" />
	<meta property="og:image" content="https://Vora.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png')}}">
    <link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
	@if(!empty(config('dz.public.pagelevel.css.'.$action))) 
        @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

    {{-- Global Theme Styles (used by all pages) --}}
    @if(!empty(config('dz.public.global.css'))) 
        @foreach(config('dz.public.global.css') as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('admin.dashboard')}}" class="brand-logo">
				<div class="logo-abbr">
                     <img class="logo-compact" src="{{ asset('assets/images/logo-icon.svg') }}" alt="">
				</div>
				<!--<img class="logo-compact" src="./images/logo-text.png" alt="">-->
				<div class="brand-title">
                        <img class="logo-compact" src="{{ asset('assets/images/infini-white-logo.svg') }}" alt="">
				</div>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('admin.partials.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('admin.partials.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
        @php
            $body_class = ''; 
            if($page == 'ui_button'){ $body_class = 'btn-page';} 
            if($page == 'ui_badge'){ $body_class = 'badge-demo';} 
        @endphp

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body {{$body_class}}">
            <!-- row -->
        <div id="successAlert" class="alert alert-success alert-dismissible" style="display: none;">
          <button type="button" class="close alert-close" data-dismiss="alert">&times;</button>  Data Updated Successfully
        </div>
        <div id="alert-container"></div>
			@yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        @stack('models')

        <!--**********************************
            Footer start
        ***********************************-->
        @include('admin.partials.footer')
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    
	<!-- Required vendors -->
	@if(!empty(config('dz.public.global.js.top')))
        @foreach(config('dz.public.global.js.top') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
        @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
        @foreach(config('dz.public.global.js.bottom') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif

    <script type="text/javascript">
        /*============================================================
        Code for sending csrf token on each ajax request
        ==============================================================*/
        $.ajaxSetup({
            headers:{
                'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*============================================================
             Function for get last parameter form url
        ==============================================================*/        
        function getLastPathname() {
            const pathname = window.location.pathname;
            const pathnameArray = pathname.split('/');
            return pathnameArray[pathnameArray.length - 1];
        }        
        /*============================================================
             Function for reset form
        ==============================================================*/
        function resetForm() {
            $('.modal form')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
        }
        $('.modal').on('hidden.bs.modal', function(e) {
            resetForm();
        });
        /*==============================================================
         Function for validation and show errors
        ==============================================================*/
        function showValidationErorrs(errors) {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $.each(errors, function(key, value) {
                var field = $('[name="' + key + '"]');
                field.addClass('is-invalid');
                field.after('<div class="invalid-feedback">' + value[0] + '</div>');

                // Remove error message and invalid class when the field is focused
                field.focus(function() {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                });
            });
        }
        /*==============================================================
         Function for messages and show errors
        ==============================================================*/
        function showAlert(type, message, alertlocation) {
            $('.modal').modal('hide');            
            var alert = $('<div class="alert alert-' + type +
                ' alert-dismissible fade show" role="alert">' + message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
            );
            $('#alert-container').append(alert);
            setTimeout(function() {
                alert.alert('close');
            }, 5000);
        }
        /*==============================================================
         Function for change title and button text and class
        ==============================================================*/
        function changeModelContent(title, btntext, btnclass, input_name, input_value, modelName) {
            $(".modal-header .modal-title").text(title);
            $(".modal-body button").text(btntext).removeClass("submit").addClass(btnclass);
            $(".hiddenInput_Js").remove();
            if ((typeof input_name !== 'undefined' && input_name !== null)) {
                var hiddenInput = $('<input>').attr({
                    type: 'hidden',
                    id: input_name,
                    class: 'hiddenInput_Js',
                    name: input_name,
                    value: input_value
                });
                $(".modal-body form").append(hiddenInput);
            } else {
                $(".hiddenInput_Js").remove();
            }
            $(`#${modelName}`).modal('show');
        }

        $(document).on('click','.alert-close',function(){
            $('#successAlert').hide();
        })
    </script>
    @stack('scripts')
	
</body>
</html>