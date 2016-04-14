<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sources')) {
            Schema::create('sources', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 100);
                $table->mediumText('content');
                $table->mediumText('url');
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
        if (Schema::hasTable('sources')) {
            Schema::drop('sources');
        }
    }
}
