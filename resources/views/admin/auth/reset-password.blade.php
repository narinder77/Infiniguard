@extends('admin.layouts.guest')
@section('content')
<div class="col-md-6">
    <div class="authincation-content">
        <div class="row no-gutters">
            <div class="col-xl-12">
                <div class="auth-form">
                    <div class="text-center mb-3">
                        <a href="{{ url('index')}}"><img src="{{ asset('assets/images/infini-white-logo.svg')}}" alt=""></a>
                    </div>
                    <h4 class="text-center mb-4 text-white">Rset Password</h4>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('password.store') }}" method="POST">
                        @csrf
                         <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <label class="text-white"><strong>Email</strong></label>
                            <input type="email" name="provider_email" value="{{ old('email', $request->email) }}" class="form-control @error('provider_email') is-invalid @enderror" placeholder="Enter your email">
                            @error('provider_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label class="text-white"><strong>Password</strong></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your new password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label class="text-white"><strong>Confirm Password</strong></label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-white text-primary btn-block">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Hide error message on input focus
            $('input[name="email"]').focus(function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').hide();
            });
        });
    </script>
@endpush