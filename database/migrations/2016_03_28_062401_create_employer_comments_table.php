<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->text('content');
            $table->string('pic_path')->nullable();
            $table->tinyInteger('ability_stars')->unsigned();
            $table->tinyInteger('attitude_stars')->unsigned();
            $table->timestamps();
            $table->integer('employer_id')->unsigned();
            $table->integer('work_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['work_id', 'user_id','employer_id']);
            $table->foreign('employer_id')->references('id')->on('employers');
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
        Schema::drop('employer_comments');
    }
}
