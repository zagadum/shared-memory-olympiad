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
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('patronymic', 255)->nullable();

            // Контактные данные
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('phone_country', 255)->nullable();

            // Адрес
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('locality', 255)->nullable();

            // Школа и возраст
            $table->string('school', 255)->nullable();
            $table->unsignedBigInteger('age_id')->nullable();

            // Дата рождения
            $table->date('dob')->nullable();

            // Состояние аккаунта
            $table->boolean('blocked')->default(false);
            $table->boolean('deleted')->default(false);
            $table->timestamp('last_login_at')->nullable();

            // Безопасность
            $table->string('password', 255);
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