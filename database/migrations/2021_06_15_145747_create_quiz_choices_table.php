<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_choices', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('level');
            $table->string('category', 50);
            $table->string('choice1', 200);
            $table->string('choice2', 200);
            $table->string('choice3', 200);
            $table->string('choice4', 200);
            $table->string('choice5', 200);
            $table->string('question', 250);
            $table->integer('answer');
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
        Schema::dropIfExists('quiz_choices');
    }
}
