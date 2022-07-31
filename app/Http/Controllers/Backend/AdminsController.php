<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminsController extends Controller
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
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $admins = Admin::all();
        $permission_groups = Admin::getpermissionGroups();
        return view('Backend.Pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $roles  = Role::all();

        return view('Backend.Pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.store')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
         // Validation Data
         $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create New Admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        session()->flash('success', 'Admin has been created !!');
        return redirect()->route('admins.index');
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $admin = Admin::find($id);
        $roles  = Role::all();
        return view('Backend.Pages.admins.edit', compact('admin', 'roles'));
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
        if (is_null($this->user) || !$this->user->can('admin.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
            // Create New Admin
            $admin = Admin::find($id);

            // Validation Data
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|max:100|email|unique:admins,email,' . $id,
                'password' => 'nullable|min:6|confirmed',
            ]);
    
    
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->username = $request->username;
            if ($request->password) {
                $admin->password = Hash::make($request->password);
            }
            $admin->save();
    
            $admin->roles()->detach();
            if ($request->roles) {
                $admin->assignRole($request->roles);
            }
    
            session()->flash('success', 'Admin has been updated !!');
            return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any role !');
        }
        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();
    }

    public function permission(){
        $admin = Admin::all();
        return view('Backend.Pages.admins.createPermission', compact('admin'));
    }
    public function permissionStore(Request $request){
        $admin = new permission();
        $admin->name = $request->name;
        $admin->group_name = $request->permission;
        $admin->save();
        return redirect()->route('permission');
    }

    public function admin(){
        return view('Backend.Pages.index');
    }
}
