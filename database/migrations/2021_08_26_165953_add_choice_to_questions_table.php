<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChoiceToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('choice1')->default('Tidak pernah');
            $table->string('choice2')->default('Sesekali');
            $table->string('choice3')->default('Kadang2');
            $table->string('choice4')->default('Selalu');
        });
    }
}
