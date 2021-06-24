<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPaper extends Model
{
    use HasFactory;

    protected $table = 'exam_paper_details';

    protected $fillable = [
        'exam_details_id', 'exam_paper_code', 'subject_code', 'ques_title', 'opt_A', 'opt_B', 'opt_C', 'opt_D', 'answer', 'marks_given', 'ques_set_by'
    ];

    public function examdetails() {

        return $this->belongsToMany(ExamDetails::class);
    }
}
