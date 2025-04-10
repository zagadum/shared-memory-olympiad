<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMParticipantsTable extends Migration
{
    public function up()
    {
        Schema::connection('memory_olympiad')->create('m_participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('lastname');
            $table->string('patronymic')->nullable();

            // Контактные данные
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_country')->nullable();

            // Адрес
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('locality')->nullable();

            // Школа и возраст
            $table->string('school')->nullable();
            $table->unsignedBigInteger('age_id')->nullable();

            // Состояние аккаунта
            $table->boolean('blocked')->default(false);
            $table->boolean('deleted')->default(false);
            $table->timestamp('last_login_at')->nullable();

            // Безопасность
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token', 80)->unique()->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('memory_olympiad')->dropIfExists('m_participants');
    }
}
