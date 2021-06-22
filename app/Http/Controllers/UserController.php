<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Subjects;
use App\Models\ExamPaper;

class UserController extends Controller
{
    public function viewExamPaperList() {

        $listpaper = ExamPaper::all();

        $data['allexampaper'] = $listpaper;

        return view('user.view-exampaper', $data);
    }

    public function viewExamPaper() {

        $subjects = Subjects::all();

        $data['subjects'] = $subjects;

        return view('user.create-exampaper', $data);
    }

    public function viewCheckExamPaper() {

        return view('user.check-exam-papers');
    }
}
