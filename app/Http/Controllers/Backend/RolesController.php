<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $role = Role::create(['name' => $request->name]);

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
        $role = Role::findById($id);
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
         // Validation Data
         $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id);
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
        $role = Role::findById($id);

        if (!is_null($role)) {
            $role->delete();
        }
        session()->flash('success', 'Role has been deleted !!');
        return redirect()->route('roles.index');
    }

    public function permission(){
        $role = Role::all();
        return view('Backend.Pages.Roles.createPermission', compact('role'));
    }
    public function permissionStore(Request $request){
        $role = new permission();
        $role->name = $request->name;
        $role->group_name = $request->permission;
        $role->save();
        return redirect()->route('permission');
    }
}
