<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->integer('firstlogin')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullname');
            $table->integer('sex');
            $table->string('avatar')->default('no_avatar.jpg');
            $table->string('phonenumber');
            $table->integer('role')->default(1);
            $table->integer('division');
            $table->string('position');
            $table->longText('permission');
            $table->integer('status')->default(1);
            $table->integer('id_leader');
            $table->longText('address');
            $table->timestamp('date_of_birth');
            $table->rememberToken();
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
