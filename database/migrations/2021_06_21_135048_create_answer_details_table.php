<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_details', function (Blueprint $table) {
            $table->id();
            $table->string('enroll_no');
            $table->string('exam_paper_code');
            $table->integer('ques_no');
            $table->string('answer');
            $table->integer('marks_obtained');
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
        Schema::dropIfExists('stud_exam_details');
    }
}
