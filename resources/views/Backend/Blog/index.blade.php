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
                        <div class="col-md-6">Manage Blog</div>
                        <div class="col-md-6">
                            @if(Auth::guard('admin')->user()->can('blog.create'))
                            <a href="{{route('blog.create')}}" class="btn btn-info" style="float:right ;">Create blog</a>
                            @endif
                        </div>
                    </div>
                    <h4 class="header-title">Blog List</h4>
                    <div class="data-tables">
                        <table id="dataTable" class="text-center" style="width:100%;">
                            <thead class="bg-light text-capitalize">
                                <tr style="text-align:justify;">
                                    <th style="width: 5%;">SL</th>
                                    <th style="width: 10%;">Image/Vedio</th>
                                    <th style="width: 10%;">Category</th>
                                    <th style="width: 20%;">Title</th>
                                    <th style="width: 50%;text-align:justify">Description</th>                                    
                                    <th style="width: 5%;">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    
                                   <td>{{$loop->index+1}}</td>
                                   <td> <img src="{{asset('BlogImage/'.$blog->image)}}" alt="" style="width:70px"> </td>
                                  <td>Electronic</td>
                                   <td style="text-align:justify">{{$blog->title}} </td>
                                   <td style="text-align:justify">{{$blog->description}} </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle hoverBtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cog settinHover" aria-hidden="true" style="font-size: 20px;"></i>
                                            </button>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 5rem;">
                                                @if(Auth::guard('admin')->user()->can('blog.edit'))
                                                <a class="dropdown-item update" href="{{route('blog.edit', $blog->id)}}">Update</a>
                                                @endif
                                                @if(Auth::guard('admin')->user()->can('blog.delete'))
                                                <a class="dropdown-item delete" href="{{ route('blog.destroy', $blog->id) }}" onclick="event.preventDefault();   if (confirm('Do You Want Sure To Delete Blog?') == true) {document.getElementById('delete-form-{{ $blog->id }}').submit();} else { 'Cancel' }; ">
                                                    Delete
                                                </a>

                                                <form id="delete-form-{{ $blog->id }}" action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display: none;">
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