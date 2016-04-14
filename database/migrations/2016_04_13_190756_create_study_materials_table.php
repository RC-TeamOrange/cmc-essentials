<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('study_materials')) {
            Schema::create('study_materials', function (Blueprint $table) {
                $table->increments('id');
                $table->smallInteger('level');
                $table->smallInteger('order');
                $table->text('title');
                $table->longText('description');
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
        if (Schema::hasTable('study_materials')) {
            Schema::drop('study_materials');
        }
    }
}
