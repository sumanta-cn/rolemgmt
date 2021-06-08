<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('roll_no');
            $table->bigInteger('enroll_no')->unique();
            $table->integer('dept_id');
            $table->string('semester');
            $table->string('section');
            $table->string('email')->unique();
            $table->string('contact_no')->unique();
            $table->string('dob');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
}
