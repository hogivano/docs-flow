<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('label_input');
            $table->boolean('is_required')->default(false);
            $table->boolean('process_show')->default(false);
            $table->unsignedInteger('related_process_action_id')->nullable();
            $table->foreign('related_process_action_id')->references('id')->on('process_actions')->onDelete('set null');
            $table->unsignedInteger('base_action_id')->nullable();
            $table->foreign('base_action_id')->references('id')->on('base_actions')->onDelete('set null');
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
        Schema::dropIfExists('process_actions');
    }
}
