@extends('Backend.layout.layouts')
@section('title', 'Add Blog')
@section('content_name')
<span>Create Blog</span>
@endsection
@section('content')
<div class="container">
    <div class="mb-5">
        <h3>Add New Blog</h3>
        @include('Backend.Partial.message')
        
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Blog Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Write Blog Title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Blog Description</label>
                <textarea type="text" name="description" id="description" cols="30" rows="10" placeholder="Write Blog Description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlFile1">Add Image</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" id="image">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlFile1">Add Vedio</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="vedio">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection