<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID пользователя');
            $table->string('login')->unique()->comment('логин пользователя');
            $table->tinyInteger('active')->comment('активность');
            $table->string('name')->default('')->comment('отображаемое имя пользователя');
            $table->string('email')->default('')->comment('email');
            $table->string('phone')->default('')->comment('Телефон');
            $table->timestamp('email_verified_at')->nullable()->comment('дата подтверждения email');
            $table->string('password')->comment('пароль');
            $table->integer('lang_id')->default(0)->comment('id языка');
            $table->rememberToken()->comment('токен');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
