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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256)->nullable();
            $table->json('content')->nullable();
            $table->integer("order")->nullable();
            $table->unsignedBigInteger('notebook_id');
            $table->timestamps();

            $table->foreign('notebook_id')
                ->references('id')
                ->on('notebooks')
                ->onUpdate("cascade")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
