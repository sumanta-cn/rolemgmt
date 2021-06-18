<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $table = 'subject_details';

    protected $fillable = [
        'dept_id', 'sem_id', 'subject_code', 'subject_name'
    ];
}
