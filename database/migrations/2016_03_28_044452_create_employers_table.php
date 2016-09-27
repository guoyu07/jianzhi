<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('pic_path')->default('default.png');
            $table->string('gender')->nullable();
            $table->integer('age')->unsigned()->nullable();
            $table->string('city')->nullable();
            $table->string('introduction')->nullable();
            $table->integer('up')->unsigned()->default(0);
            $table->integer('fans')->unsigned()->default(0);
            $table->integer('exp')->unsigned()->default(0);
            $table->boolean('type')->default(0);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employers');
    }
}
