<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('pic_path')->default('default.png');
            $table->integer('age')->unsigned()->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->text('introduction')->nullable();
            $table->integer('up')->unsigned()->default(0);
            $table->integer('fans')->unsigned()->default(0);
            $table->integer('exp')->unsigned()->default(0);
            $table->string('school')->nullable();
            $table->string('major')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
