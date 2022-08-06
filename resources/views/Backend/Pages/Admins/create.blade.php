@extends('Backend.layout.layouts')
@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<script src="{{asset('js/parsley.min.js')}}"></script>


@include('Backend.Partial.validationCss')
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Create New Admin</h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('admins.store') }}" method="POST" id="admin">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Admin Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Admin Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Password</label>
                                
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required data-parsley-pattern="[a-z]+[A-Z]+[1-9]+$" data-parsley-length="[8,8]" data-parsley-trigger="keyup" data-parsley-error-message="Password Is not Valid <span style='color:green'> Password Must Be minimum 1 small letter 1 Capital letter and 1 number and Maximum 8 Digit</span>" >
                                
                                <input type="checkbox" id="showPass" ></i>
                                <input type="checkbox" id="blockPass"  style="display: none; "></i>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password" required data-parsley-equalto="#password" data-parsley-trigger="keyup" data-parsley-error-message="Password Is not Same <span style='color:green'> Please Enter Same Password</span>">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password_confirmation">User Name</label>
                                <input type="text" class="form-control" id="password_confirmation" name="username" placeholder="Enter Your User name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Assign Roles</label>
                                <select name="roles[]" id="tags" class="form-control select3" multiple="multiple">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Admin</button>
                    </form>

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
            document.getElementById("showPass").style.display = "none";
            document.getElementById("blockPass").style.display = "block";
            
        } else {
            input.type = "password"
        }
    })
</script>
<script>
    let btnBlock = document.querySelector('#blockPass');
    let inputBlock = document.querySelector('#password');

    btnBlock.addEventListener('click', () => {
        if (inputBlock.type === "text") {
            input.type = "password";
            document.getElementById("showPass").style.display = "block";
            document.getElementById("blockPass").style.display = "none";
            
        } else {
            input.type = "password"
        }
    })
</script>
@endsection