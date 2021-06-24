<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sem_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('dept_id');
            $table->string('section');
            $table->integer('pass_marks');
            $table->integer('full_marks');
            $table->string('exam_date');
            $table->integer('total_question');
            $table->integer('duration_in_min');
            $table->foreign('sem_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('exam_details');
    }
}
