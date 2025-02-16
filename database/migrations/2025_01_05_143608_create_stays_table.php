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
            // $table->string('amenities');
            $table->float('price')->default(0);
            $table->integer('numberofbedrooms')->nullable();
            $table->integer('maxnumofguests')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_recommended')->default(false);
            $table->boolean('availability')->default(true);
            $table->boolean('has_ac')->default(false);
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_tv')->default(false);
            $table->string('main_pic');
            $table->string('banner');
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
