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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stay_id');
            $table->unsignedBigInteger( 'user_id');
            $table->integer('beds'); // Number of beds
            $table->float('pricepernight');
            $table->string('room_number');
            $table->boolean('availability')->default(true);
            $table->boolean('has_ac')->default(false); // Air conditioning availability
            $table->boolean('has_wifi')->default(false); // WiFi availability
            $table->boolean('has_tv')->default(false); // TV availability
            $table->foreign('stay_id')->references('id')->on('stays')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
};
