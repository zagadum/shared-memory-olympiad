<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMOlympiadDescriptionsTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_olympiad_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_olympiad_id');
            $table->string('language', 10); // Код языка (uk, pl, en)
            $table->text('short_description'); // Краткое описание
            $table->text('full_description'); // Полное описание
            $table->timestamps();

            // Внешний ключ на `m_olympiads`
            $table->foreign('m_olympiad_id')
                ->references('id')
                ->on('m_olympiads')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_olympiad_descriptions');
    }
}
