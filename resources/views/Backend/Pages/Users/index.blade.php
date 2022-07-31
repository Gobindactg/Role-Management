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
                        <div class="col-md-6">Manage User</div>
                        @if(Auth::guard('admin')->user()->can('user.create'))
                        <div class="col-md-6">
                            <a href="{{route('users.create')}}" class="btn btn-info" style="float:right ;">Create User</a>
                        </div>
                        @endif
                    </div>
                    <h4 class="header-title">User List</h4>
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
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                    @foreach ($user->roles as $role)
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
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                            @if(Auth::guard('admin')->user()->can('user.edit'))
                                                <a class="dropdown-item update" href="{{route('users.edit', $user->id)}}">Update</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->can('user.delete'))
                                                <a class="dropdown-item delete" href="{{ route('users.destroy', $user->id) }}" onclick="event.preventDefault();   if (confirm('Do You Want Sure To Delete User?') == true) {document.getElementById('delete-form-{{ $user->id }}').submit();} else { 'Cancel' }; ">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                @endif
                                            </div>
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