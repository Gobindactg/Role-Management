@extends('Backend.layout.layouts')
@section('content')
<style>
    .update:hover {
        color: green;
        transform: scale(1.3);

    }

    .delete:hover {
        color: red;
        transform: scale(1.3);

    }

    .hoverBtn:hover {
        background-color: green;
    }

    .settinHover:hover {
        transform: scale(1.3);
        color: yellow;

    }
</style>
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">Manage Admin</div>
                        <div class="col-md-6">
                        @if(Auth::guard('admin')->user()->can('block.user'))
                            <a href="{{route('admins.create')}}" class="btn btn-info" style="float:right ;">Create Admin</a>
                            @endif
                        </div>
                    </div>
                    <h4 class="header-title">Admin List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center" style="width:100%;">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                    @foreach ($admin->roles as $role)
                                            <span class="badge badge-info mr-1">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle hoverBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cog settinHover" aria-hidden="true" style="font-size: 20px;"></i>
                                            </button>
                                            @if(Auth::guard('admin')->user()->can('block.user'))
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                                <a class="dropdown-item update" href="{{route('admins.edit', $admin->id)}}">Update</a>
                                                <a class="dropdown-item delete" href="{{ route('admins.destroy', $admin->id) }}" onclick="event.preventDefault();   if (confirm('Do You Want Sure To Delete admin?') == true) {document.getElementById('delete-form-{{ $admin->id }}').submit();} else { 'Cancel' }; ">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>

@endsection