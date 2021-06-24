<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'dept_id', 'sem_id', 'subject_code', 'subject_name'
    ];

    public function departments() {

        return $this->hasMany(Department::class, 'id', 'dept_id');
    }

    public function semesters() {

        return $this->hasMany(Semester::class, 'id', 'sem_id');
    }
}
