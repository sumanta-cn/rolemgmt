<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    use HasFactory;

    protected $table = 'student_details';

    protected $fillable = [
        'user_id', 'contact_no', 'roll_no', 'enroll_no', 'semester', 'section', 'department'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semesters($semester) {

        $getsem = Semester::where('semester_no', $semester)->first();

        return $getsem;
    }

    public function departments($department) {

        $getdept = Department::where('dept_name', $department)->first();

        return $getdept;
    }
}
