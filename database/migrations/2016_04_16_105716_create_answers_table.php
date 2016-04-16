<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('answers')) {
            Schema::create('answers', function (Blueprint $table) {
                $table->increments('id');
                $table->smallInteger('rank');
                $table->text('content');
                $table->smallInteger('correct');
                $table->timestamps();
                $table->integer('question_id')->unsigned()->nullable();
                $table->foreign('question_id')->references('id')->on('questions');
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
        if (Schema::hasTable('answers')) {
            Schema::drop('answers');
        }
    }
}
