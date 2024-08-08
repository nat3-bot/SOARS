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
        Schema::create('student_organizations', function (Blueprint $table) {
            $table->id('studentId');
            $table->string('course')->nullable();
            $table->string('org1')->nullable();
            $table->string('org1_memberstatus')->nullable();
            $table->string('org2')->nullable();
            $table->string('org2_memberstatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_organizations');
    }
};
