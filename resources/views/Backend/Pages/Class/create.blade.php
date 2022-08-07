@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">New Class</span>
@endsection
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5" style="border: 1px solid teal;">
            <div class="card">
                <div class="card-body">
                    <h4 class="pb-4">Create New Admin</h4>
                    @include('Backend.Partial.message')
                    <form action="{{ route('class.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Class Name</label>
                                <input type="text" class="form-control" id="class_name" name="class_name" placeholder="Enter Class Name">
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name">Group Name</label>
                                <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Group Name">
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