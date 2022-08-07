@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">Edit Class # {{$class->name}}</span>
@endsection
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5" style="border: 1px solid teal;">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Edit Class # <span style="color:teal">{{$class->name}}</span></h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('class.update', $class->id) }}" method="POST">
                    @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Class Name</label>
                                <input type="text" class="form-control" id="class_name" value="{{$class->name}}" name="class_name" placeholder="Enter Class Name">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Group Name</label>
                                <input type="text" class="form-control" id="group_name" value="{{$class->group_name}}" name="group_name" placeholder="Enter Group Name">
                            </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save info</button>
                </form>

            </div>
        </div>
    </div>
    <!-- data table end -->
</div>
</div>
@endsection