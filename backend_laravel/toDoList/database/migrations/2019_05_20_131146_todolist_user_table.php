<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TodolistUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todolists', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('user_name');
            $table->string('job');
            $table->boolean('done');
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
        //
    }
}
