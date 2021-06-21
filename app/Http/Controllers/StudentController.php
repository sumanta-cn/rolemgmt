<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function viewExamPage() {

        return view('student.view-exam-page');
    }

    public function getExamResult() {

        return view('student.view-exam-result');
    }
}
