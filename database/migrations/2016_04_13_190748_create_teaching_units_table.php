<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('teaching_units')) {
            Schema::create('teaching_units', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug');
                $table->smallInteger('level');
                $table->text('title');
                $table->longText('description');
                $table->timestamps();
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
        if (Schema::hasTable('teaching_units')) {
            Schema::drop('teaching_units');
        }
    }
}
