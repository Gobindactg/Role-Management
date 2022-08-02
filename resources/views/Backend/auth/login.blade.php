@extends('Backend.auth.auth_master')

@section('auth_title')
Login | Admin Panel
@endsection

<style>
      .parsley-errors-list li {
            list-style: none;
            color: red;
            font-family: tahoma;
            font-style: italic;
            padding-top: 1px;
            margin-top: 1px;
            font-weight: 700;
            text-align: left;
        }
</style>
@section('auth-content')
<!-- login area start -->

<div class="container" style="padding-top: 8%;">
    <div class="card">
        <div class="card-header">
            <div class="text-center pt-2 text-primary">
                <h4>Welcome To Multi Role Admin Dashboard</h4>
                <p>A Simple Way To Complete Soluation</p>
            </div>
        </div>
        <div class="card-body">
            @include('Backend.Partial.message')
            <form method="POST" action="{{ route('admin.login.submit') }}" id="admin_validated">
                @csrf

                <div class="login-form-body">

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address or username ') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-error-message="Email Is not Valid <span style='color:green'> Please Enter Correct Email</span>">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
            </form>
        </div>
        <div class="card-footer text-muted text-center">
            All Copyright@2022
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><!-- login area end -->

<script>
    $(function() {
        $("#admin_validated").parsley();

    })
</script>
@endsection