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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id'); // Polymorphic representation
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['stay', 'car']);
            $table->integer('number_of_guests')->nullable(); // Relevant for properties
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price', 10, 2); 
            $table->enum('booking_status', ['pending', 'confirmed', 'canceled']); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
