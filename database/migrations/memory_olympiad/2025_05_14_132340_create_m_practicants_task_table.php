<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPracticantsTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_practicants_task', function (Blueprint $table) {
            $table->id('task_id');
            $table->unsignedBigInteger('practicant_id')->nullable();
            $table->unsignedBigInteger('olympiad_id')->nullable();
            $table->unsignedBigInteger('params_id')->nullable();
            $table->date('date_start')->nullable();
            $table->longText('add_params')->nullable();
            $table->tinyInteger('is_self')->default(0);
            $table->tinyInteger('is_done')->default(0);

            $table->index('practicant_id');
            $table->index('olympiad_id');
            $table->index('params_id');
            $table->index('date_start');
            $table->index('is_self');
            $table->index('is_done');

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
        Schema::dropIfExists('m_practicants_task');
    }
}