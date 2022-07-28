@extends('Backend.layout.layouts')
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4>Create New Role</h4>
                    <form action="{{route('roles.store')}}" method="post">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Role Name">
                        </div>
                        <div class="form-group ">
                            <label for="">Permission</label>
                            @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" id="checkPermission{{$permission->id}}"  value="{{$permission->name}}">
                                <label class="form-check-label" for="checkPermission{{$permission->id}}" >
                                    {{$permission->name}}
                                </label>
                            </div>

                            @endforeach
                        </div>
                        <div class="custom-control custom-checkbox">

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