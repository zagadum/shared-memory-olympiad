<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPaymentsTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_payments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('payment_date');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('olympiad_id');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_payments');
    }
}
