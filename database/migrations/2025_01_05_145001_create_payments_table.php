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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('booking_id');
        $table->decimal('amount', 10, 2);
        $table->string('payment_method'); // e.g., 'credit_card', 'paypal', 'bank_transfer'
        $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);
        $table->timestamp('payment_date')->nullable(); // Optional, for recording when payment was made
        $table->text('transaction_id')->nullable(); // For tracking external payment gateway transactions

        $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
