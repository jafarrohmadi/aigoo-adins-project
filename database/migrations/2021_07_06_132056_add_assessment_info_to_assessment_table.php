<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssessmentInfoToAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessment', function (Blueprint $table) {
            $table->string('assessment_info')->nullable();
            $table->string('assessment_year_month')->nullable();
        });
    }
}
