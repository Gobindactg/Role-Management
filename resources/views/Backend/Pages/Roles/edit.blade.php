@extends('Backend.layout.layouts')
@section('content')


<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="page-title-area">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Dashboard</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="{{route('roles.index')}}">All Roles</a></li>
                                        <li><span>Edit Roles</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 clearfix">
                                <div class="user-profile pull-right">
                                    <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Kumkum Rai <i class="fa fa-angle-down"></i></h4>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Message</a>
                                        <a class="dropdown-item" href="#">Settings</a>
                                        <a class="dropdown-item" href="#">Log Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 5px; font-style:italic; font-family:tahoma; font-weight:900; text-transform:uppercase">
                        <h4>Role Edit <span class="text-primary"> # {{$role->name}}</span></h4>
                    </div>

                    @include('Backend.Partial.message')
                    <form action="{{route('roles.update', $role->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group mt-3">
                            <label for="">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" readonly value="{{ $role->name }}" placeholder="Enter Your Role Name">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkPermissionAll" value="1" {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : ''}}>
                            <label class="form-check-label" for="checkPermissionAll"> All </label>
                            <hr>
                        </div>
                        <div style="padding:5px">
                            @php $i = 1; @endphp
                            @foreach($permission_groups as $groups)
                            <div class="row">
                                @php
                                $permissions = App\Models\User::getpermissionsByGroupName($groups->name);
                                $j = 1;
                                @endphp
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permission" id="{{$i}}Management" value="{{$groups->name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : ''}}>
                                        <label class="form-check-label" for="checkPermission" style="text-transform:uppercase ;">
                                            {{$groups->name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-9 role-{{$i}}-management-checkbox">

                                    @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}} id="checkPermission{{$permission->id}}" value="{{$permission->name}}">
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

                        <button class="btn btn-primary mt-2 pr-4 pl-4" type="submit">Update Role</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

 

@include('Backend.Partial.customjs')
@endsection