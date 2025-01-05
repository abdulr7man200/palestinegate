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
        Schema::create('stays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['apartment', 'hotel', 'chalet']);
            $table->text('description'); 
            $table->string("city");
            $table->string('streetaddress'); 
            $table->decimal('price', 10, 2); 
            $table->integer('number_of_bedrooms'); 
            $table->integer('max_number_of_guests'); 
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stays');
    }
};
