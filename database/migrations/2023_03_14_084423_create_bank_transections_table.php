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
        Schema::create('bank_transections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->constrained();
            $table->text('entry_date');
            $table->double('debit')->nullable();
            $table->double('credit')->nullable();
            $table->string('type');
            $table->string('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transections');
    }
};
