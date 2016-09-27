<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('work_id')->unsigned();
            $table->boolean('apply_status')->default(0);
            $table->boolean('pass_status')->default(0);
            $table->boolean('reject_status')->default(0);
            $table->boolean('finished_status')->default(0);
            $table->primary(['work_id', 'user_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('work_id')
                    ->references('id')
                    ->on('works')
                    ->onDelete('cascade');
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
        Schema::drop('apply_jobs');
    }
}
