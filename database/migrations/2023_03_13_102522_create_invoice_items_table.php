<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transection_id')->constrained();
            $table->string('item');
            $table->string('size');
            $table->float('width');
            $table->float('height');
            $table->float('square_ft');
            $table->integer('qty');
            $table->float('total_square_ft');
            $table->float('rate');
            $table->float('price');
            $table->text('entry_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
};
