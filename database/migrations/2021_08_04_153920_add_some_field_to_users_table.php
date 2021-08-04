<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company')->nullable();
            $table->string('bu')->nullable();
            $table->string('subbu')->nullable();
            $table->string('nik')->nullable();
            $table->string('jobposition')->nullable();
            $table->text('worklocationname')->nullable();
            $table->string('statusincompany')->nullable();
        });
    }
}
