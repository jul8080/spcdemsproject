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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('school_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('department');
            $table->string('position');
            $table->string('gender');
            $table->string('entry_level')->default('regular');
            $table->string('image')->nullable();
            $table->string('role_as')->default('user');
            $table->string('employee_status')->default('active');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('last_seen')->nullable();
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
        Schema::dropIfExists('users');
    }
};
