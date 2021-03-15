<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('operation');
            $table->string('userName');
            $table->string('description');
            $table->integer('quantity');
            $table->enum('deleted',[1,0])->default(0);
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->unsignedBigInteger('supplier_id')->default(0);
            $table->unsignedBigInteger('export_bill');
            $table->unsignedBigInteger('import_bill');
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('export_bill')->references('id')->on('export_bills');
            $table->foreign('import_bill')->references('id')->on('emport_bills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
