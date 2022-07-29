@extends('Backend.layout.layouts')
@section('content')
<style>
    .update:hover{
        color:green;
        transform:scale(1.3);
       
    }
    .delete:hover{
        color:red;
        transform:scale(1.3);
 
    }
    .hoverBtn:hover{
        background-color: green;
    }
    .settinHover:hover{
        transform:scale(1.3);
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
                        <div class="col-md-6">
                            <a href="{{route('roles.create')}}" class="btn btn-info" style="float:right ;">Create Role</a>
                        </div>
                    </div>
                    <h4 class="header-title">Role List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center" style="width:100%;">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Guard Name</th>
                                    <th>Created</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->guard_name}}</td>
                                    <td>{{$role->created_at}}</td>
                                    <td>
                                        <div class="dropdown" >
                                            <button class="btn btn-info dropdown-toggle hoverBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cog settinHover" aria-hidden="true" style="font-size: 20px;" ></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                                <a class="dropdown-item update" href="{{route('roles.edit', $role->id)}}">Update</a>
                                                <a class="dropdown-item delete" href="#">Delete</a>
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