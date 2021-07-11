<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizCompletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_completes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->enum('level', ['Staff', 'Managerial']);
            $table->string('category', 50);
            $table->string('question', 200);
            $table->string('choice1', 200);
            $table->string('choice2', 200);
            $table->string('choice3', 200);
            $table->string('choice4', 200);
            $table->string('choice5', 200);
            $table->string('choice6', 200);
            $table->string('answer', 255);
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
        Schema::dropIfExists('quiz_completes');
    }
}
