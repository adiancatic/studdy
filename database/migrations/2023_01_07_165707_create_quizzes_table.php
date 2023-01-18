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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string("title", 256);
            $table->integer("order")->nullable();
            $table->unsignedBigInteger("note_id")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->timestamps();

            $table->foreign("note_id")
                ->references("id")
                ->on("notes")
                ->onUpdate("cascade")
                ->onDelete("set null");

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('quizzes');
    }
};
