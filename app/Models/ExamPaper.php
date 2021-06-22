<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPaper extends Model
{
    use HasFactory;

    protected $table = 'exam_paper_details';

    protected $fillable = [
        'exam_paper_code', 'subject_code', 'ques_type', 'ques_title', 'opt_A', 'opt_B', 'opt_C', 'opt_D', 'marks_given', 'ques_set_by'
    ];
}
