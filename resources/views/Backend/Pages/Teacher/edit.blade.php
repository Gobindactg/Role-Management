@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">create Edit # <span style="color: teal; font-size:18px">{{$teacher->name}}</span></span>
@endsection
<style>
    label {
        font-weight: 900;
        font-size: 16px;
        color: black;
    }
</style>
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-2" style="border:1px solid teal; padding:5px">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Create New Teacher</h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Teacher Name (<span style="color:red">*</span>)</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$teacher->name}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Teacher Designation (<span style="color:red">*</span>)</label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{$teacher->designation}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Teacher Email (<span style="color:red">optional</span>)</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$teacher->email}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Phone (<span style="color:red">optional</span>)</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{$teacher->phone_number}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Education Degree (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="education" name="education" value="{{$teacher->education_degree}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Subject (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="{{$teacher->subject}}">
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email">Image (<span style="color:red">optional</span>)</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" id="image" accept="image/*" onchange="loadFile(event)">
                                <span class="text-danger" id="image-input-error"></span>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email">New Image </label>
                                <div>
                                    <img style="border: 1px solid teal; width:80px; height:80px" id="output" />
                                </div>

                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="email">Old Image </label>
                                <div>
                                    <img src="{{asset('TeacherImage/'.$teacher->image)}}" style="border: 1px solid teal; width:80px; height:80px" />
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">About: (<span style="color:red">optional</span>)</label>
                            <textarea class="form-control" rows="5" id="about" name="about">{{$teacher->about}}</textarea>
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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>

@endsection