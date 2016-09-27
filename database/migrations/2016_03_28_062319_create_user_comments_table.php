<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->text('content');
            $table->string('pic_path')->nullable();
            $table->tinyInteger('pay_stars')->unsigned();
            $table->tinyInteger('description_stars')->unsigned();
            $table->tinyInteger('payspeed_stars')->unsigned();
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('work_id')->unsigned();
            $table->primary(['work_id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('work_id')
                    ->references('id')
                    ->on('works')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_comments');
    }
}
