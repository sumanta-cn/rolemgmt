<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Semester;
use App\Models\Department;
use App\Models\Permission;
use App\Models\UserDetails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        foreach($user->roles as $role) {
            $role = $role->role_name;
        }
        foreach($user->permissions as $permission) {
            $permission = $permission->permission_name;
        }

        if($role == 'admin') {

            $totaluser = User::count();
            $data['totaluser'] = $totaluser;
        }

        $data['role'] = $role;
        // $data['permission'] = $permission;

        return view('dashboard.home', $data);
    }

    public function viewRoles() {

        $roles = Role::with('permissions')->get();
        $perm = Permission::all();

        $data['roles'] = $roles;
        $data['permissions'] = $perm;

        return view('dashboard.add-roles', $data);
    }

    public function addRoles(Request $request) {

        $rolename = strtolower($request->role_name);
        $perms = $request->permname;

        if($request->action == 'create') {

            $role = Role::create(['role_name' => $rolename]);

            foreach($perms as $p) {
                $permcheck = Permission::where('permission_name', $p)->firstOrFail();
                $role->permissions()->attach($permcheck);
            }
        }
        elseif($request->action == 'update') {

            $role = Role::where('id', $request->roleid)->firstOrFail();
            $role->role_name = $rolename;
            $role->save();

            $allperm = Permission::all();
            foreach ($allperm as $perm) {
                $role->permissions()->detach($perm);
            }

            foreach($perms as $p) {
                $permcheck = Permission::where('permission_name', $p)->firstOrFail();
                $role->permissions()->attach($permcheck);
            }
        }
        elseif($request->action == 'delete') {

            Role::where('id', $request->roleid)->delete();
        }

        return redirect()->route('viewroles');
    }

    public function viewPermissions() {

        $permissions = Permission::all();
        $data['permissions'] = $permissions;

        return view('dashboard.add-permissions', $data);
    }

    public function addPermissions(Request $request) {

        $permission = Str::slug($request->permission_name);

        if($request->action == 'create') {

            Permission::create(['permission_name' => $permission]);
        }
        elseif($request->action == 'update') {

            Permission::where('id', $request->permissionid)->update(['permission_name' => $permission]);
        }
        elseif($request->action == 'delete') {

            Permission::where('id', $request->permissionid)->delete();
        }

        return redirect()->route('viewpermissions');
    }

    public function viewUser() {

        $users = User::with('userdetails', 'roles', 'permissions')->get();

        $data['users'] = $users;

        return view('dashboard.add-user', $data);
    }

    public function viewUserDetails() {

        $dept = Department::all();
        $sem = Semester::all();
        $perm = Permission::all();
        $role = Role::all();

        $data['departments'] = $dept;
        $data['semesters'] = $sem;
        $data['permissions'] = $perm;
        $data['roles'] = $role;

        return view('dashboard.add-user-details', $data);
    }

    public function addUserDetails(Request $request) {

        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required',
            'contact_no' => 'required',
        ]);

        $passval = time();

        $name = $request->name;
        $email = $request->email;
        $pwd = $request->session()->put('userpwd', $passval);
        $contno = $request->contact_no;
        $department = $request->department;
        $role = $request->rolename;
        $perms = $request->permname;

        $adduser = new User();
        $adduser->name = $name;
        $adduser->email = $email;
        $adduser->password = Hash::make($passval);
        $adduser->save();

        $adduserdetails = new UserDetails();
        $adduserdetails->contact_no = $contno;
        $adduserdetails->department = $department;
        $adduser->userdetails()->save($adduserdetails);

        $rolecheck = Role::where('role_name', $role)->first();
        $adduser->roles()->attach($rolecheck);
        foreach($perms as $val) {
            $permcheck = Permission::where('permission_name', $val)->firstOrFail();
            $adduser->permissions()->attach($permcheck);
        }

        return redirect()->route('viewuser');
    }
}
