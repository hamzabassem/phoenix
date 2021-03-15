<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_bills', function (Blueprint $table) {
            $table->id()->autoIncrement();
            //$table->string('name');
            $table->string('description');
            $table->integer('category_id');
            $table->string('category_name');
            $table->string('bill_number');
            $table->enum('processing',[1,0])->default(1);
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('totalPrice');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('export_bills');
    }
}
