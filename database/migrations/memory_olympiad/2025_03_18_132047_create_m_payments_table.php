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
            $table->unsignedBigInteger('participant_id')->index();
            $table->unsignedBigInteger('olympiad_id')->index();
            $table->intager('is_pay')->default(0)->comment('0 - not pay, 1 - pay')->index();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10);
            $table->enum('status', ['pending', 'ok', 'failed'])->default('pending');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_payments');
    }
}
