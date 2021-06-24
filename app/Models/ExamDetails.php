<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDetails extends Model
{
    use HasFactory;

    protected $table = 'exam_details';

    protected $fillable = [
        'sem_id', 'subject_id', 'dept_id', 'section', 'pass_marks', 'full_marks', 'exam_date', 'total_question'
    ];
}
