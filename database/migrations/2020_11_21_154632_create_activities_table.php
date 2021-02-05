<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id("id");
            $table->string("activities_name");
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->string("language");
            $table->longText("user_commentaire");
            $table->longText("teacher_commentaire");
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users');

        });

        /*Schema::table('activity', function($table){
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
