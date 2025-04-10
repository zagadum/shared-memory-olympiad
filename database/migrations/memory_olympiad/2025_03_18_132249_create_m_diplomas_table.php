<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDiplomasTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_diplomas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_olympiad_id');
            $table->string('template_name');
            $table->enum('category', ['1_place', '2_place', '3_place', '4_place', 'participant']);
            $table->text('diploma_text');
            $table->timestamps();

            $table->foreign('m_olympiad_id')->references('id')->on('m_olympiads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_diplomas');
    }
}
