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
        Schema::create('propety_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->date("payment_date");
            $table->decimal("amount", 10, 2);
            $table->string("paymentStatus");
            $table->foreign('property_id')->references('id')->on('propety_bookings')->onDelete('cascade');
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
        Schema::dropIfExists('propety_payments');
    }
};
