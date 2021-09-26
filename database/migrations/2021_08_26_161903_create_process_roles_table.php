<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedInteger('process_id');
            $table->foreign('process_id')->references('id')->on('process')->onDelete('cascade');
            $table->boolean('read')->default(true);
            $table->boolean('create')->default(true);
            $table->boolean('update')->default(true);
            $table->boolean('delete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_roles');
    }
}
