<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersRoleLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_role_link', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->integer('user_id')->index()->comment('ID пользователя');
            $table->integer('role_id')->index()->comment('ID роли');
            $table->float('active')->index()->comment('ID роли');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_role_link');
    }
}
