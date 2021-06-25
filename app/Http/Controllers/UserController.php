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
        $exams = ExamDetails::with('subjects')->where('id', $examid)->get();

        $data['examdetails'] = $exams;
        $data['examid'] = $examid;

        return view('user.create-exampaper', $data);
    }

    public function crudForExamPaper(Request $request) {

        $subjcode = $request->subject;
        $questitle = $request->ques_title;
        $choice = $request->choicename;
        $optA = $request->optA;
        $optB = $request->optB;
        $optC = $request->optC;
        $optD = $request->optD;

        if($request->singleanswer) {

            $answer = $request->singleanswer;
        }

        $getansr = $request->multipleanswer;
        if($getansr) {

            sort($getansr);
            $answer = implode(', ', $getansr);
        }

        $marks = $request->marks_given;
        $quessetby = auth()->user()->name;
        $examid = $request->examid;

        if($request->action == 'create') {

            $exmpapercode = $subjcode . $examid . '-' . date('mY') ;

            ExamPaper::create([
                'exam_details_id' => $examid,
                'exam_paper_code' => $exmpapercode,
                'subject_code' => $subjcode,
                'ques_title' => $questitle,
                'choice_type' => $choice,
                'opt_A' => $optA,
                'opt_B' => $optB,
                'opt_C' => $optC,
                'opt_D' => $optD,
                'answer' => $answer,
                'marks_given' => $marks,
                'ques_set_by' => $quessetby
            ]);
        }
        elseif($request->action == 'update') {

            $exmpapercode = $request->exampapercode;

            ExamPaper::where('id', $request->paperid)->update([
                'exam_details_id' => $examid,
                'exam_paper_code' => $exmpapercode,
                'subject_code' => $subjcode,
                'ques_title' => $questitle,
                'choice_type' => $choice,
                'opt_A' => $optA,
                'opt_B' => $optB,
                'opt_C' => $optC,
                'opt_D' => $optD,
                'answer' => $answer,
                'marks_given' => $marks,
                'ques_set_by' => $quessetby
            ]);
        }
        elseif($request->action == 'delete') {

            ExamPaper::where('id', $request->paperid)->delete();
        }

        return redirect()->route('viewexams');
    }

    public function viewExampaperList(Request $request) {

        $examid = $request->id;
        $exampapers = ExamPaper::where('exam_details_id', $examid)->get();

        $data['listexampapers'] = $exampapers;

        return view('user.list-exampapers', $data);
    }

    public function viewCheckExamPaper() {

        return view('user.check-exam-papers');
    }
}
