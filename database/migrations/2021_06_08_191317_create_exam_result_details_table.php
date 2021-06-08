<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_result_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('result_of');
            $table->integer('marks_obtained');
            $table->integer('total_marks');
            $table->integer('right_ques');
            $table->integer('wrong_ques');
            $table->integer('unattempt_ques');
            $table->bigInteger('stud_exam_id');
            $table->string('result_published_by');
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
        Schema::dropIfExists('exam_result_details');
    }
}
