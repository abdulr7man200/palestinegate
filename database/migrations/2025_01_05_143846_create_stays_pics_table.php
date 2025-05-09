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
        Schema::create('stays_pics', function (Blueprint $table) {
            $table->id();
            $table->string("path");
            $table->unsignedBigInteger("stay_id");
            $table->foreign("stay_id")->references("id")->on("stays")->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stays_pics');
    }
};
