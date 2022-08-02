<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{asset('assets/images/icon/logo.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active">
                        <a href="{{route('dashboard')}}" aria-expanded="true"><i class="ti-dashboard"></i> <span>Admin Dashboard</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i> <span>Admin Management</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('admin.view'))
                            <li><a href="{{route('admins.index')}}">All Admin</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->can('admin.create'))
                            <li><a href="{{route('admins.create')}}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i> <span>Role Management</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('role.view'))
                            <li><a href="{{route('roles.index')}}">All Role</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->can('role.create'))
                            <li><a href="{{route('roles.create')}}">Create Role</a></li>
                            <li><a href="{{route('permission')}}">Create Permission</a></li>
                            @endif

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>User Management</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('user.view'))
                            <li><a href="{{route('users.index')}}">All User</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->can('user.create'))
                            <li><a href="{{route('users.create')}}">Create User</a></li>
                            @endif

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>Blog Management</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('blog.view'))
                            <li><a href="{{route('blog.index')}}">All Blog</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->can('blog.create'))
                            <li><a href="{{route('blog.create')}}">Create Blog</a></li>
                            @endif

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>Teacher Management</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('teacher.view'))
                            <li><a href="{{route('teacher.index')}}">All Teacher</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->can('teacher.create'))
                            <li><a href="{{route('teacher.create')}}">Create teacher</a></li>
                            @endif

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>class Management</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('class.view'))
                            <li><a href="{{route('class.index')}}">All class</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->can('class.create'))
                            <li><a href="{{route('class.create')}}">Create class</a></li>
                            @endif

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-cog settinHover"></i> <span>Setting</span></a>
                        <ul class="collapse">
                            @if(Auth::guard('admin')->user()->can('class.view'))
                            <li><a href="{{route('class.index')}}">School Profile Setting</a></li>
                            @endif
                         

                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>