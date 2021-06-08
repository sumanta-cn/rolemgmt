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
        Schema::create('stud_exam_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam_given_by');
            $table->string('exam_paper_code');
            $table->integer('ques_no');
            $table->string('ques_title');
            $table->string('answer_given');
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
