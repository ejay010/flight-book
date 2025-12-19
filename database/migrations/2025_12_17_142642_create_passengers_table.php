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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            //WHo
            $table->string('first_name');
            $table->string('last_name');
            $table->string('id_type');
            $table->string('id_number');
            $table->date('date_of_birth');
            //Contact
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->foreignId('reservation_id'); // belongs to a reservation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
