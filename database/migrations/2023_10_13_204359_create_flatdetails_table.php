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
        Schema::create('flatdetails', function (Blueprint $table) {
            $table->id();
            $table->string('flat_id', 10);
            $table->string('flat_name', 25);
            $table->string('sft', 10);
            $table->string('bed_room', 10);
            $table->string('dining_room', 10);
            $table->string('drawing_room', 10);
            $table->string('bath_room', 10);
            $table->string('kitchen_room', 10);
            $table->string('store_room', 10);
            $table->string('belkuni', 10);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('flatdetails');
    }
};
