<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('quizzes')) {
            Schema::create('quizzes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug');
                $table->smallInteger('level');
                $table->text('title');
                $table->timestamps();
                $table->integer('teaching_unit_id')->unsigned()->nullable();
                $table->foreign('teaching_unit_id')->references('id')->on('teaching_units');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('quizzes')) {
            Schema::drop('quizzes');
        }
    }
}
