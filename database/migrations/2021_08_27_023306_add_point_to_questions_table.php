<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->integer('point1')->default(1);
            $table->integer('point2')->default(2);
            $table->integer('point3')->default(3);
            $table->integer('point4')->default(4);
        });
    }
}
