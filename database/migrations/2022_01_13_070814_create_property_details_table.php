<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_details', function (Blueprint $table) {
            $table->id('property_details_id');
            $table->biginteger('property_list_id');
            $table->string('name');
            $table->string('location');
            $table->string('area');
            $table->string('image');
            $table->integer('room');
            $table->integer('price');
            
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
        Schema::dropIfExists('property_details');
    }
}
