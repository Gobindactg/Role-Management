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
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">Manage Class</div>
                        <div class="col-md-6">
                            @if(Auth::guard('admin')->user()->can('class.create'))
                            <a href="{{route('class.create')}}" class="btn btn-info" style="float:right ;">Create Class</a>
                            @endif
                        </div>
                    </div>
                    <h4 class="header-title">Class List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center" style="width:100%;">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Class Name</th>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classs as $class)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$class->name}}</td>
                                    <td>{{$class->group_name}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle hoverBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cog settinHover" aria-hidden="true" style="font-size: 20px;"></i>
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                                @if(Auth::guard('admin')->user()->can('class.edit'))
                                                <a class="dropdown-item update" href="{{route('class.edit', $class->id)}}">Update</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->can('class.delete'))
                                                <a class="dropdown-item delete" href="{{ route('class.destroy', $class->id) }}" onclick="event.preventDefault();   if (confirm('Do You Want Sure To Delete class?') == true) {document.getElementById('delete-form-{{ $class->id }}').submit();} else { 'Cancel' }; ">
                                                    Delete
                                                </a>

                                                <form id="delete-form-{{ $class->id }}" action="{{ route('class.destroy', $class->id) }}" method="POST" style="display: none;">
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