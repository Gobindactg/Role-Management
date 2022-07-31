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
                        <div class="col-md-6">Manage Role</div>
                        @if(Auth::guard('admin')->user()->can('block.user'))
                        <div class="col-md-6">
                            <a href="{{route('roles.create')}}" class="btn btn-info" style="float:right ;">Create Role</a>
                            <a href="{{route('permission')}}" class="btn btn-info ml-2 mr-2" style="float:right ;">Create Permission</a>
                        </div>
                        @endif
                    </div>
                    <h4 class="header-title">Role List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center" style="width:100%;">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Permission Name</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                        <span class="badge mr-1">| {{$permission->name}} | </span>
                                        @endforeach
                                    </td>

                                    <td>
                                    
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle hoverBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cog settinHover" aria-hidden="true" style="font-size: 20px;"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                            @if(Auth::guard('admin')->user()->can('role.edit'))
                                                <a class="dropdown-item update" href="{{route('roles.edit', $role->id)}}">Update</a>
                                            @endif
                                            @if(Auth::guard('admin')->user()->can('role.delete'))
                                                <a class="dropdown-item delete" href="{{ route('roles.destroy', $role->id) }}" onclick="event.preventDefault();   if (confirm('Do You Want Sure To Delete Role?') == true) {document.getElementById('delete-form-{{ $role->id }}').submit();} else { 'Cancel' }; ">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
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