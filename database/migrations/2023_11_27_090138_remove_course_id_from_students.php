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
        Schema::table('students', function (Blueprint $table) {
            
            $table->dropForeign(['course_id']); // Drop foreign key constraint
            $table->dropColumn('course_id'); // Remove the course_id column
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            
            $table->unsignedBigInteger('course_id'); // Re-add the course_id column
            $table->foreign('course_id')
                ->references('id')->on('courses')->onDelete('cascade'); // Re-add foreign key constraint
                
        });
    }
};
