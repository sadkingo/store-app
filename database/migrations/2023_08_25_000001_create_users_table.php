<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('address');
            $table->string('phone');
            $table->string('user_type');
            $table->softDeletes();
            $table->timestamps();
            $table->enum('status', ['approved', 'pending', 'rejected', 'cancelled']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
