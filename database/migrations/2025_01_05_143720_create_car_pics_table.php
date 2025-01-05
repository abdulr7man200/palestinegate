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
        Schema::create('propety_pics', function (Blueprint $table): void {
            $table->id();
            $table->string('path');
            $table->unsignedBigInteger("car_id");
            $table->foreign("car_id")->references("id")->on("cars")->onDelete('cascade');

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
        Schema::dropIfExists('propety_pics');
    }
};
