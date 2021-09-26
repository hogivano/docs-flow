<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('order');
            $table->unsignedInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications');
            $table->text('description')->nullable();
            $table->text('message_pending')->nullable();
            $table->text('message_failure')->nullable();
            $table->text('message_success')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process');
    }
}
