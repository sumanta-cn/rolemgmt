<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subjects;
use App\Models\ExamPaper;
use App\Models\ExamDetails;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
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
        $totalpaper = ExamPaper::count();

        if($role == 'student') {

            $stud = StudentDetails::where('user_id', $user->id)->first();
            $sem = $stud->semesters($stud->semester);
            $dept = $stud->departments($stud->department);
            $getexm = ExamDetails::where('sem_id', $sem->id)->where('dept_id', $dept->id)->first();

            $data['examdetails'] = $getexm;

            return view('student.student-home', $data);
        }

        $data['totaluser'] = $totaluser;
        $data['totalsubject'] = $totalsubj;
        $data['totalexam'] = $totalexam;
        $data['totalexmpaper'] = $totalpaper;

        $data['role'] = $role;

        return view('dashboard.home', $data);
    }
}
