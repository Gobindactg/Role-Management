<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('role.view')) {
            
            session()->flash('error','Sorry !! You are Unauthorized to view any role !');
           
            return redirect()->route('admin.login');
        }
        $roles = Role::all();
        return view('Backend.Pages.Roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $all_permissions = Permission::orderBy('id', 'desc')->get();
        $permission_groups = User::getpermissionGroups();

        return view('Backend.Pages.Roles.create', compact('all_permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        // ['guard_name', 'web'];
        // $role = new Role();
        // $role->name = $request->name;
        // $role->guard_name = 'web';
        // $role->save();

        // $role = DB::table('roles')->where('name', $request->name)->first();
        // validation data
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.required' => 'Please give Role Name'
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        // $role = new Role();
        // $role->name = $request->name;
        $role->guard_name = $request->guardName;
        $role->save();

        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        // session()->flash('success', 'Role has been created !!');

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $role = Role::findById($id, 'admin');
        $permissions = Permission::all();
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('Backend.Pages.Roles.edit', compact('role', 'permissions', 'all_permissions', 'permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id, 'admin');
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been updated !!');
        return redirect()->route('roles.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $role = Role::findById($id, 'admin');

        if (!is_null($role)) {
            $role->delete();
        }
        session()->flash('success', 'Role has been deleted !!');
        return redirect()->route('roles.index');
    }

    public function permission()
    {
        $role = Role::all();
        return view('Backend.Pages.Roles.createPermissions', compact('role'));
    }
    public function permissionStore(Request $request)
    {
        $role = new permission();
        $role->name = $request->name;
        $role->group_name = $request->permission;
        $role->guard_name = $request->guardName;
        $role->save();
        return redirect()->route('permission');
    }
}
