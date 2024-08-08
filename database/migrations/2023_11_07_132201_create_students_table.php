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
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id')->primary(); // Define 'student_id' as a string primary key.
            $table->string('last_name'); 
            $table->string('middle_initial')->nullable(); // Make 'middle_initial' nullable.
            $table->string('first_name');
            $table->unsignedBigInteger('course_id')->nullable(); // Foreign key
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('organization1')->nullable();
            $table->string('organization2')->nullable();
            $table->string('password');
            $table->string('org1_member_status')->nullable();
            $table->string('org2_member_status')->nullable();
            $table->integer('user_roles')->default(3); // Roles: 4=User/Student, 3=Student Officer, 2=OSA Personnel, 1=admin
            $table->string('phone_number')->nullable();
            //$table->string('member_position');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
