<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMOlympiadTasksTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_olympiad_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_olympiad_id');
            $table->text('task_description');
            $table->string('task_type'); // Тип задания (тест, эссе, практическое)
            $table->timestamps();

            $table->foreign('m_olympiad_id')->references('id')->on('m_olympiads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_olympiad_tasks');
    }
}

