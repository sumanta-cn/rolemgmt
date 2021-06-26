<?php

namespace App\Http\Controllers;

use App\Models\ExamPaper;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function viewExamPage(Request $request) {

        $examid = $request->examid;
        $examdetails = ExamPaper::where('exam_details_id', $examid)->simplePaginate(1);

        $data['examdetails'] = $examdetails;

        return view('student.view-exam-page', $data);
    }

    public function getExamResult() {

        return view('student.view-exam-result');
    }
}
