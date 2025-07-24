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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('trip_type');
            $table->string('departure');
            $table->string('departure_date');
            $table->string('return_date')->nullable();
            $table->string('destination');
            $table->integer('passenger_count');
            $table->json('primary_contact'); // Storing primary contact as JSON
            $table->json('passengers'); // Storing passengers as JSON
            $table->string('payment_status')->default('unpaid'); // Adding status field with default value
            $table->string('confirmation')->default('pending'); // Adding status field with default value
            $table->string('reference_number')->unique(); // Adding reference number field with unique constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
