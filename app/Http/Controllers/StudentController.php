<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function viewRegisterPage() {

        return view('student.self-registration');
    }
}
