<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['text', 'file', 'number', 'boolean', 'datetime']);
            $table->string('location')->nullable();
            $table->string('validation')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_actions');
    }
}
