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
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('lang',["ar","en"])->default("en");
            $table->unsignedBigInteger('store_id');
            $table->enum('level',[1,2,3,4])->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');

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
