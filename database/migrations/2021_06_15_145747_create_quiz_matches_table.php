<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level');
            $table->string('category', 50);
            $table->string('question', 200);
            $table->string('wrong_question', 200)->comment('Wrong Question');
            $table->string('answer', 200);
            $table->string('wrong_answer', 200);
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
        Schema::dropIfExists('quiz_matches');
    }
}
