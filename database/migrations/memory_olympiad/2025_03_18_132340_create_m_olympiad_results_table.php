<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMOlympiadResultsTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_olympiad_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_olympiad_id');
            $table->unsignedBigInteger('m_participant_id');
            $table->unsignedBigInteger('m_task_id')->nullable();
            $table->date('result_date');
            $table->integer('score')->default(0);
            $table->integer('total_tasks')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('wrong_answers')->default(0);
            $table->decimal('accuracy_percentage', 5, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('m_olympiad_id')->references('id')->on('m_olympiads')->onDelete('cascade');
            $table->foreign('m_participant_id')->references('id')->on('m_participants')->onDelete('cascade');
            $table->foreign('m_task_id')->references('id')->on('m_olympiad_tasks')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_olympiad_results');
    }
}
