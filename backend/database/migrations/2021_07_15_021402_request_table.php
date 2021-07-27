<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');  // người gửi yêu cầu
            $table->string('id_approve')->default('0');   //người phê duyệt
            $table->string('id_requesttype');
            $table->integer('tinh_trang')->default(0);
            $table->longText('description');
            $table->time('time_under');
            $table->time('time_on');
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
        Schema::dropIfExists('request');
    }
}
