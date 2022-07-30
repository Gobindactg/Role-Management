@extends('Backend.layout.layouts')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4>Create New Permission</h4>
                    <a href="{{route('roles.create')}}" class="btn btn-info mb-2" style="float:right ;">Create Role</a>
                    @include('Backend.Partial.message')
                    <form action="{{route('permission.store')}}" method="post">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Permission Name">
                            <br>
                            <select name="permission" id="" class="form-select">                                                          
                                @foreach($role as $roles)
                                <option value="{{$roles->name}}">{{$roles->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary mt-2 pr-4 pl-4" type="submit">Save Role</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

@endsection