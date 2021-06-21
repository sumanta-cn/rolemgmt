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
            $table->integer('sem_id');
            $table->string('section');
            $table->string('subject_code');
            $table->integer('pass_marks');
            $table->integer('full_marks');
            $table->date('exam_date');
            $table->integer('total_question');
            $table->integer('duration_in_min');
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
