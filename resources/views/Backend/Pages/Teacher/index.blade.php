@extends('Backend.layout.layouts')
@section('content_name')
<span style="color:green">All Teacher</span>
@endsection
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
        <div class="col-12 mt-2" style="border:1px solid teal; padding:5px">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">Manage Teacher</div>
                        <div class="col-md-6">
                            @if(Auth::guard('admin')->user()->can('teacher.create'))
                            <a href="{{route('teacher.create')}}" class="btn btn-info" style="float:right ;">Create Teacher</a>
                            @endif
                        </div>
                    </div>
                    <h4 class="header-title">Teacher List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center" style="width:100%;">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Education</th>
                                    <th>Subject</th>
                                    <th>About</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$teacher->name}}</td>
                                    <td>{{$teacher->designation}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->phone_number}}</td>
                                    <td>{{$teacher->education_degree}}</td>
                                    <td>{{$teacher->subject}}</td>
                                    <td>{{$teacher->about}}</td>
                                    <td><img src="{{asset('TeacherImage/'.$teacher->image)}}" alt="" style="width: 70px;"></td>
                                    <td>
                                        @if($teacher->is_delete == 1) <span style="color:green">Active</span>
                                        @else <span style="color:red">Deleted</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle hoverBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cog settinHover" aria-hidden="true" style="font-size: 20px;"></i>
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                                @if(Auth::guard('admin')->user()->can('teacher.edit'))
                                                @if($teacher->is_delete == 1)
                                                <a class="dropdown-item update" href="{{route('teacher.edit', $teacher->id)}}">Update</a>
                                                @else <span style="color:red">This Profile Already Delete </span>

                                                @endif
                                                @endif
                                                @if(Auth::guard('admin')->user()->can('teacher.delete'))
                                                @if($teacher->is_delete == 1)
                                                <a class="dropdown-item delete" href="{{ route('teacher.destroy', $teacher->id) }}" onclick="event.preventDefault();   if (confirm('Do You Want Sure To Delete admin?') == true) {document.getElementById('delete-form-{{ $teacher->id }}').submit();} else { 'Cancel' }; ">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $teacher->id }}" action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>

                                                @endif
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