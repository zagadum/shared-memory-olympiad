<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRankingsTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_rankings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_olympiad_id');
            $table->unsignedBigInteger('m_participant_id');
            $table->integer('place');
            $table->integer('score');
            $table->timestamps();

            $table->foreign('m_olympiad_id')->references('id')->on('m_olympiads')->onDelete('cascade');
            $table->foreign('m_participant_id')->references('id')->on('m_participants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_rankings');
    }
}
