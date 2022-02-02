<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id('agent_id');
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('email');
            $table->string('password');
            $table->integer('unique_id');
            $table->integer('account_created');
            $table->integer('status');
            $table->string('office');
            $table->string('broker_photo');
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
        Schema::dropIfExists('agents');
    }
}
