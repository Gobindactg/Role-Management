@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">New Admin</span>
@endsection
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
<script src="{{asset('js/parsley.min.js')}}"></script>
<style>
    .select2-container .select2-selection--multiple {
        min-height: 44px;
    }

    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 12px;
    }
</style>
@include('Backend.Partial.validationCss')
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Create New Admin</h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('admins.store') }}" method="POST" id="admin">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Admin Name</label>
                                <input type="text" class="form-control" id="name" name="name" required data-parsley-pattern="[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-error-message="Name Is not Valid <span style='color:green'> Please Enter Correct Name</span>" placeholder="Enter Admin Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Admin Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-error-message="Email Is not Valid <span style='color:green'> Please Enter Correct Email</span>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required data-parsley-pattern="[a-z]+[A-Z]+[1-9]+$" data-parsley-length="[8,8]" data-parsley-trigger="keyup" data-parsley-error-message="Password Is not Valid <span style='color:green'> Password Must Be minimum 1 small letter 1 Capital letter and 1 number and Maximum 8 Digit</span>" data-parsley-errors-container=".nameError">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="password_show_hide();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="nameError">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password" required data-parsley-equalto="#password" data-parsley-trigger="keyup" data-parsley-error-message="Password Is not Same <span style='color:green'> Please Enter Same Password</span>" data-parsley-errors-container=".confirmError">
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="confirmpassword_show_hide();">
                                            <i class="fas fa-eye" id="confirm_show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="confirm_hide_eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="confirmError">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">User Name</label>
                                <input type="text" class="form-control" id="password_confirmation" name="username" placeholder="Enter Your User name" required data-parsley-pattern="[a-zA-Z]+$" data-parsley-trigger="keyup" data-parsley-error-message="User Name Is not Valid <span style='color:green'> User Name Must Be minimum 1 small letter 1 Capital letter and No Speach </span>" data-parsley-errors-container=".usernameError">
                                <div class="usernameError">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="Assign Role">Assign Roles</label>
                                <select name="roles[]" id="tags" class="form-control select3" style="height: 180px;" multiple="multiple" required data-parsley-trigger="keyup" data-parsley-required=true data-parsley-error-message="Your are Not Select Any Role <span style='color:green'> Please Select Minimum One Role or More </span>" data-parsley-errors-container=".role">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div class="role">
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
              
           
                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Admin</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->
</div>
</div>

<script>
    var values = $('#tags option[selected="true"]').map(function() {
        return $(this).val();
    }).get();

    // you have no need of .trigger("change") if you dont want to trigger an event
    $('#tags').select2({
        placeholder: "Please select Your Role Permission"
    });
</script>
<script>
    $(function() {
        $("#admin").parsley();
    });
</script>
<script src="{{asset('js/jquery-3.6.0.js')}}"></script>
<script>
    let btn = document.querySelector('#showPass');
    let input = document.querySelector('#password');

    btn.addEventListener('click', () => {
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password"
        }
    })
</script>

<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>
<script>
    function confirmpassword_show_hide() {
        var y = document.getElementById("password_confirmation");
        var confirm_show_eye = document.getElementById("confirm_show_eye");
        var confirm_hide_eye = document.getElementById("confirm_hide_eye");
        confirm_hide_eye.classList.remove("d-none");
        if (y.type === "password") {
            y.type = "text";
            confirm_show_eye.style.display = "none";
            confirm_hide_eye.style.display = "block";
        } else {
            y.type = "password";
            confirm_show_eye.style.display = "block";
            confirm_hide_eye.style.display = "none";
        }
    }
</script>
@endsection