<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Semester;
use App\Models\Subjects;
use App\Models\Department;
use App\Models\Permission;
use App\Models\ExamDetails;
use App\Models\UserDetails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

        $totaluser = User::count();
        $totalsubj = Subjects::count();
        $totalexam = ExamDetails::count();

        $data['totaluser'] = $totaluser;
        $data['totalsubject'] = $totalsubj;
        $data['totalexam'] = $totalexam;

        $data['role'] = $role;

        return view('dashboard.home', $data);
    }

    public function viewRoles() {

        $roles = Role::with('permissions')->get();
        $perm = Permission::all();

        $data['roles'] = $roles;
        $data['permissions'] = $perm;

        return view('dashboard.add-roles', $data);
    }

    public function crudForRoles(Request $request) {

        $rolename = strtolower($request->role_name);
        $rolecheck = Role::where('role_name', $rolename)->exists();
        if($rolecheck) {
            return redirect()->back()->with('rolemissmatch', 'Role already exists.');
        }
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

    public function crudForPermissions(Request $request) {

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
        $rolewithperm = Role::with('permissions')->get();
        $perm = Permission::all();

        $data['users'] = $users;
        $data['rolewithperms'] = $rolewithperm;
        $data['permissions'] = $perm;

        return view('dashboard.list-users', $data);
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
        Session::put('userpwd', $passval);

        $name = $request->name;
        $email = $request->email;
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
        if($perms != null) {
            foreach($perms as $val) {
                $permcheck = Permission::where('permission_name', $val)->firstOrFail();
                $adduser->permissions()->attach($permcheck);
            }
        }
        else {
            foreach($rolecheck->permissions as $val) {
                $permcheck = Permission::where('permission_name', $val->permission_name)->firstOrFail();
                $adduser->permissions()->attach($permcheck);
            }
        }

        return redirect()->route('viewuser');
    }

    public function updateUserDetails(Request $request) {

        $name = $request->username;
        $email = $request->useremail;
        $rolename = $request->rolename;
        $perms = $request->permname;

        $updateusr = User::where('id', $request->userid)->firstOrFail();
        $updateusr->name = $name;
        $updateusr->email = $email;
        $updateusr->save();

        $allrole = Role::all();
        foreach($allrole as $role) {
            $updateusr->roles()->detach($role);
        }

        $rolecheck = Role::where('role_name', $rolename)->first();
        $updateusr->roles()->attach($rolecheck);

        if(count($perms) > 0) {

            $allperm = Permission::all();
            foreach ($allperm as $perm) {
                $updateusr->permissions()->detach($perm);
            }

            foreach($perms as $p) {
                $permcheck = Permission::where('permission_name', $p)->firstOrFail();
                $updateusr->permissions()->attach($permcheck);
            }
        }

        return redirect()->route('viewuser');
    }

    public function deleteUserDetails(Request $request) {

        $usercheck = User::where('id', $request->userid)->exists();
        if($usercheck) {
            User::where('id', $request->userid)->delete();
        }

        return redirect()->route('viewuser');
    }

    public function viewSubjects() {

        $dept = Department::all();
        $sem = Semester::all();
        $subj = Subjects::with('departments', 'semesters')->get();

        $data['departments'] = $dept;
        $data['semesters'] = $sem;
        $data['subjects'] = $subj;

        return view('dashboard.add-subjects', $data);
    }

    public function crudForSubjects(Request $request) {

        if($request->action == 'create') {

            $deptid = $request->department;
            $semid = $request->semester;
            $subjname = $request->subj_name;

            $subcheck = Subjects::where('subject_name', $subjname)->exists();
            if($subcheck) {

                return redirect()->back()->with('suberror', 'Subject Name Exists!');
            }

            $dept = Department::where('id', $deptid)->first();
            $subjectcode = $dept->dept_name . $deptid . $semid;

            Subjects::create([
                'dept_id' => $deptid,
                'sem_id' => $semid,
                'subject_code' => $subjectcode,
                'subject_name' => $subjname
            ]);
        }
        elseif($request->action == 'update') {

            $deptid = $request->department;
            $semid = $request->semester;
            $subjname = $request->subj_name;

            $subcheck = Subjects::where('subject_name', $subjname)->exists();
            if($subcheck) {

                return redirect()->back()->with('suberror', 'Subject Name Exists!');
            }

            $dept = Department::where('id', $deptid)->first();
            $subjectcode = $dept->dept_name . $deptid . $semid;

            Subjects::where('id', $request->subjid)->update([
                'dept_id' => $deptid,
                'sem_id' => $semid,
                'subject_code' => $subjectcode,
                'subject_name' => $subjname
            ]);
        }
        elseif($request->action == 'delete') {

            Subjects::where('id', $request->subjid)->delete();
        }

        return redirect()->route('viewsubject');
    }

    public function viewSceduledExams() {

        $listexams = ExamDetails::with('subjects', 'departments', 'semesters')->get();
        $subj = Subjects::all();

        $data['subjects'] = $subj;
        $data['listexams'] = $listexams;

        return view('dashboard.list-exams', $data);
    }

    public function viewSceduleExamPage() {

        $subj = Subjects::all();

        $data['subjects'] = $subj;

        return view('dashboard.view-schedule-exam', $data);
    }

    public function crudForScheduledExam(Request $request) {

        $this->validate($request, [
            'pass_marks' => ['required', 'numeric'],
            'full_marks' => ['required', 'numeric'],
            'total_question' => ['required', 'numeric'],
        ]);

        if($request->action == 'create') {

            ExamDetails::create([
                'sem_id' => $request->semid,
                'subject_id' => $request->subject,
                'dept_id' => $request->deptid,
                'section' => $request->section,
                'pass_marks' => $request->pass_marks,
                'full_marks' => $request->full_marks,
                'exam_date' => $request->exam_date,
                'total_question' => $request->total_question,
            ]);
        }
        elseif($request->action == 'update') {

            ExamDetails::where('id', $request->examid)->update([
                'sem_id' => $request->semid,
                'subject_id' => $request->subject,
                'dept_id' => $request->deptid,
                'section' => $request->section,
                'pass_marks' => $request->pass_marks,
                'full_marks' => $request->full_marks,
                'exam_date' => $request->exam_date,
                'total_question' => $request->total_question,
            ]);
        }
        elseif($request->action == 'delete') {

            ExamDetails::where('id', $request->examid)->delete();
        }

        return redirect()->route('listscheduledexam');
    }

    public function getSubjectDetails(Request $request) {

        $subjid = $request->subjid;
        $getdata = Subjects::with('departments', 'semesters')->where('id', $subjid)->first();

        $data['getdata'] = $getdata;

        return json_encode($data);
    }
}
