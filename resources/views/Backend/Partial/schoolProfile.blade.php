@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">create Teacher</span>
@endsection
<style>
    label {
        font-weight: 900;
        font-size: 16px;
        color: black;
    }
</style>
<script src="{{asset('js/jquery-3.6.0.js')}}"></script>
   <script src="{{asset('js/parsley.min.js')}}"></script>
@include('Backend.Partial.validationCss')
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-2" style="border:1px solid teal; padding:5px">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Create New Teacher</h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data" id="teacher" >
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Teacher Name (<span style="color:red">*</span>)</label>
                                <input type="text" class="form-control" id="name" name="name" required data-parsley-pattern="[a-z A-Z]+$" data-parsley-trigger="keyup" data-parsley-error-message="Name Is not Valid <span style='color:green'> Please Enter Correct Name</span>" placeholder="Enter Teacher Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                               
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Teacher Designation (<span style="color:red">*</span>)</label>
                                <select name="designation" id="designation" class="form-control">
                                    <option value="Head Teacher">-- Head Teacher --</option>
                                    <option value="Assistant Teacher">-- Assistant Teacher --</option>
                                    <option value="Lecturer">-- Lecturer --</option>
                                    <option value="Principal">-- Principal --</option>
                                    <option value="Senior Teacher">-- Senior Teacher --</option>
                                </select>
                             
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Teacher Email (<span style="color:red">optional</span>)</label>

                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-error-message="Email Is not Valid <span style='color:green'> Please Enter Correct Email</span>">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Phone (<span style="color:red">optional</span>)</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" required data-parsley-length="[11,11]" data-parsley-trigger="keyup" data-parsley-error-message="Number Is not Valid <span style='color:green'> Phone Number Must Be 11 Digit</span>">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Education Degree (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="education" name="education" placeholder="Enter Height Degree">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Subject (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Image (<span style="color:red">optional</span>)</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" id="image">
                                <span class="text-danger" id="image-input-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">About: (<span style="color:red">optional</span>)</label>
                            <textarea class="form-control" rows="5" id="about" name="about"></textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Teacher</button>
                        </div>
                </div>


                </form>

            </div>
        </div>
    </div>
    <!-- data table end -->
</div>
</div>

<script>
    $(function(){
        $("#teacher").parsley();
    });
</script>

@endsection