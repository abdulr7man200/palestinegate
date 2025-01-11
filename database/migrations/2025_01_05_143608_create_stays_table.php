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
        Schema::create('stays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['hotels', 'apartments', 'chales']);
            $table->string('description');
            $table->string("city");
            $table->string('streetaddress');
            $table->string('amenities');
            $table->float('price');
            $table->integer('numberofbedrooms');
            $table->integer('maxnumofguests');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_recommended')->default(false);
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
        Schema::dropIfExists('propeties');
    }
};
