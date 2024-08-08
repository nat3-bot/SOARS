<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('osa', function (Blueprint $table) {
            $table->string('employee_id')->primary();
            $table->string('last_name'); 
            $table->string('middle_initial')->nullable(); // Make 'middle_initial' nullable.
            $table->string('first_name');
            $table->string('email');
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->integer('user_role')->default(2); // Roles: 4=User/Student, 3=Student Officer, 2=OSA Personnel, 1=admin
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osa');
    }
};
