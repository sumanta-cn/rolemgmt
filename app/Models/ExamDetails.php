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

    public function subjects() {

        return $this->hasMany(Subjects::class, 'id', 'subject_id');
    }

    public function departments() {

        return $this->hasMany(Department::class, 'id', 'dept_id');
    }

    public function semesters() {

        return $this->hasMany(Semester::class, 'id', 'sem_id');
    }
}
