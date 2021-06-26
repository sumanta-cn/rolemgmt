<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDetails extends Model
{
    use HasFactory;

    protected $table = 'answer_details';

    protected $fillable = [
        'enroll_no', 'exam_paper_code', 'ques_no', 'answer', 'marks_obtained'
    ];
}
