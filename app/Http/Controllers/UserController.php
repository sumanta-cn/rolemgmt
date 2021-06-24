<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subjects;
use App\Models\ExamPaper;
use App\Models\ExamDetails;

class UserController extends Controller
{
    public function viewExamList() {

        $listexam = ExamDetails::with('subjects', 'departments', 'semesters')->get();

        $data['listexams'] = $listexam;

        return view('user.list-exams', $data);
    }

    public function viewExamPaper(Request $request) {

        $examid = $request->id;
        $subjects = Subjects::all();

        $data['subjects'] = $subjects;
        $data['examid'] = $examid;

        return view('user.create-exampaper', $data);
    }

    public function createExamPaper(Request $request) {

        $subjcode = $request->subject;
        $questitle = $request->ques_title;
        $optA = $request->optA;
        $optB = $request->optB;
        $optC = $request->optC;
        $optD = $request->optD;

        if($request->singleanswer) {

            $answer = $request->singleanswer;
        }

        $getansr = $request->multipleanswer;
        if(count($getansr) > 0) {

            sort($getansr);
            $answer = implode(', ', $getansr);
        }

        $marks = $request->marks_given;
        $quessetby = auth()->user()->name;
        $examid = $request->examid;
        $exmpapercode = $subjcode . $examid . rand(0000, 9999);

        ExamPaper::create([
            'exam_details_id' => $examid,
            'exam_paper_code' => $exmpapercode,
            'subject_code' => $subjcode,
            'ques_title' => $questitle,
            'opt_A' => $optA,
            'opt_B' => $optB,
            'opt_C' => $optC,
            'opt_D' => $optD,
            'answer' => $answer,
            'marks_given' => $marks,
            'ques_set_by' => $quessetby
        ]);

        return redirect()->route('viewexams');
    }
    public function viewCheckExamPaper() {

        return view('user.check-exam-papers');
    }
}
