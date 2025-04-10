<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMOlympiadsTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_olympiads', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Название олимпиады
            $table->enum('type', ['Украинская', 'Польская', 'Международная']);
            $table->string('country');
            $table->string('city')->default('Вся Украина');
            $table->date('announcement_start_date'); // Дата начала анонса
            $table->date('announcement_end_date'); // Дата окончания анонса
            $table->date('activation_date'); // Дата активации олимпиады
            $table->date('start_date'); // Дата начала
            $table->date('end_date'); // Дата окончания
            $table->json('language_tabs'); // Мультиязычные описания
            $table->enum('status', ['draft', 'announced', 'active', 'completed'])->default('draft');
            $table->unsignedBigInteger('created_by'); // ID создателя
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_olympiads');
    }
}

