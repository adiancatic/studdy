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
        Schema::create('quiz_entries', function (Blueprint $table) {
            $table->id();
            $table->string("question", 256);
            $table->text("answer")->nullable();
            $table->unsignedBigInteger("quiz_id");
            $table->timestamps();

            $table->foreign("quiz_id")
                ->references("id")
                ->on("quizzes")
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
        Schema::dropIfExists('quiz_entries');
    }
};
