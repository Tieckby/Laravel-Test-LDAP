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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullName')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phoneNumber')->nullable()->unique();
            $table->string('password')->nullable();
            $table->boolean('email_verified');

            $table->boolean('deleted')->default(false);
            $table->boolean('enabled')->default(true);
            $table->dateTime('startDate')->useCurrent();
            $table->dateTime('endDate')->nullable();

            $table->foreignId('department_id')->constrained('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
