<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('id');
            $table->string('invoice_number');
            $table->date('invoice_Date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('product');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade'); 
            $table->integer('amount_collection');
            $table->integer('amount_commission');
            $table->decimal('discount',8,2);
            $table->decimal('value_vat',8,2);
            $table->string('rate_vat', 999);
            $table->decimal('total',8,2);
            $table->string('status', 50);
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
