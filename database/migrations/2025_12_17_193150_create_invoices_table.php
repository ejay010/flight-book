<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id'); //one to one relationship
            $table->string('reference_id')->nullable();
            $table->string('status')->default('Unpaid');
            $table->integer('subtotal');
            $table->integer('total');
            $table->integer('discount');
            $table->string('bill_to_first_name');
            $table->string('bill_to_last_name');
            $table->string('bill_to_email');
            $table->string('bill_to_phone_number');
            $table->string('terms');
            $table->string('payment_link');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
