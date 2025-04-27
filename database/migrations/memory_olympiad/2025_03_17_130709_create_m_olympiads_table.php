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
            $table->string('title', 255);
            $table->unsignedBigInteger('country_id')->default(0);
            $table->unsignedBigInteger('region_id')->nullable()->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->string('locality', 255)->nullable();
            $table->enum('promotion', ['ads', 'olympiad'])->nullable()->default('olympiad');
            $table->integer('is_international')->nullable()->default(0);
            $table->date('announcement_start_date');
            $table->date('announcement_end_date');
            $table->date('activation_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['draft', 'announced', 'active', 'completed'])->default('draft');
            $table->unsignedInteger('local_price')->nullable()->default(0);
            $table->string('local_currency', 3)->nullable()->default('UAH');
            $table->decimal('international_price', 10, 2)->unsigned()->nullable()->default(0.00);
            $table->string('international_currency', 3)->nullable()->default('EUR');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_olympiads');
    }
}