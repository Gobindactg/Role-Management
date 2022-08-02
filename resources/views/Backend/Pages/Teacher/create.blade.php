@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">create Teacher</span>
@endsection
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-2" style="border:1px solid teal; padding:5px">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Create New Teacher</h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('teacher.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Teacher Name (<span style="color:red">*</span>)</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Teacher Name">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Teacher Designation (<span style="color:red">*</span>)</label>
                                <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Teacher Designation">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Admin Email (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Phone (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Education Degree (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Subject (<span style="color:red">optional</span>)</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Image (<span style="color:red">optional</span>)</label>
                                <input type="file" class="form-control" id="email" name="email" placeholder="Upload Image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">About: (<span style="color:red">optional</span>)</label>
                            <textarea class="form-control" rows="5" id="about" name="about"></textarea>
                        </div>

                </div>

                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Teacher</button>
                </form>

            </div>
        </div>
    </div>
    <!-- data table end -->
</div>
</div>


@endsection