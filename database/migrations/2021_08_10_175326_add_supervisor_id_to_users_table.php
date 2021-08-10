<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupervisorIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('supervisor_id')->nullable();
            $table->string('bu_code')->nullable();
            $table->string('sub_bu_code')->nullable();
            $table->string('department_code')->nullable();
            $table->string('job_level')->nullable();
        });
    }
}
