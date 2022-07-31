@extends('Backend.layout.layouts')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4>Create New Role</h4>
                    @include('Backend.Partial.message')
                    <form action="{{route('roles.store')}}" method="post">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Role Name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Role Guard</label>
                            <select name="guardName" id="" class="form-select" >
                                <option value="">-- Select Guard Name --</option>
                                <option value="admin">Admin (For Admin Controll)</option>
                                <option value="web">User (For User Controll)</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkPermissionAll" value="1">
                            <label class="form-check-label" for="checkPermissionAll"> All </label>
                            <hr>
                        </div>
                        <div style="padding:5px">
                        @php $i = 1; @endphp
                        @foreach($permission_groups as $groups)
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permission" id="{{$i}}Management" value="{{$groups->name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)">
                                    <label class="form-check-label" for="checkPermission" style="text-transform:uppercase ;">
                                        {{$groups->name}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9 role-{{$i}}-management-checkbox">
                                @php
                                $permissions = App\Models\User::getpermissionsByGroupName($groups->name);
                                $j = 1;
                                @endphp
                                @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" id="checkPermission{{$permission->id}}" value="{{$permission->name}}">
                                    <label class="form-check-label" for="checkPermission{{$permission->id}}">
                                        {{$permission->name}}
                                    </label>
                                </div>
                                @php $j++; @endphp
                                
                                @endforeach
                                <hr>
                               
                                
                            </div>
                        </div>
                        @php $i++; @endphp
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

@include('Backend.Partial.customjs')
@endsection