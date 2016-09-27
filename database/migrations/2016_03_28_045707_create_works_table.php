<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->string('work_time');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->tinyInteger('need_num')->unsigned();
            $table->tinyInteger('hired_num')->unsigned()->default(0);
            $table->integer('pay')->unsigned();
            $table->string('pay_type');
            $table->string('pay_time');
            $table->string('commission')->nullable();
            $table->string('lunch');
            $table->string('gender');
            $table->string('contact');
            $table->timestamp('interview_time');
            $table->string('interview_place');
            $table->string('interviewer');
            $table->text('requirements');
            $table->text('description');
            $table->boolean('checked')->default(0);
            $table->boolean('applyable')->default(0);
            $table->boolean('finished')->default(0);
            $table->text('check_failed_msg')->nullable();
            $table->integer('page_view')->unsigned();
            $table->integer('employer_id')->unsigned();
            $table->timestamps();
            $table->foreign('employer_id')->references('id')->on('employers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('works');
    }
}
