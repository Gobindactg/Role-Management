@extends('Backend.layout.layouts')
@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="page-title-area bg-info">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="breadcrumbs-area clearfix">
                                    <h4 class="page-title pull-left">Dashboard</h4>
                                    <ul class="breadcrumbs pull-left">
                                        <li><a href="{{route('admins.index')}}">All Admins</a></li>
                                        <li><span>Edit Roles</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 clearfix">
                                <div class="admin-profile pull-right">
                                    
                                    <img class="avatar user-thumb" src="{{asset('assets/images/author/avatar.png')}}" alt="avatar" style="width: 70px; border:1px solid black;">
                                    <span class="user-name dropdown-toggle" data-toggle="dropdown">Kumkum Rai <i class="fa fa-angle-down"></i></span>
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
                        <h4>User Edit <span class="text-primary"> # {{$admin->name}}</span></h4>
                    </div>
                    <!-- page title area end -->

                    <div class="main-content-inner">
                        <div class="row">
                            <!-- data table start -->
                            <div class="col-12 mt-2">
                                <div class="card">
                                    <div class="card-body">

                                        @include('Backend.Partial.message')

                                        <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="name">User Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $admin->name }}">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="email">User Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $admin->email }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="password_confirmation">User Name</label>
                                                    <input type="text" class="form-control" id="password_confirmation" name="username" value="{{ $admin->username }}">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="password">Assign Roles</label>
                                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                                        @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- data table end -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

@endsection