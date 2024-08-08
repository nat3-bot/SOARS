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
        Schema::create('petitions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('requirement_status')->nullable();
            $table->string('name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('type_of_organization')->nullable();
            $table->string('academic_course_based')->nullable();
            $table->mediumText('consti_and_byLaws')->nullable();
            $table->mediumText('letter_of_intent')->nullable();
            $table->string('admin_endorsement')->nullable();
            $table->string('signees')->nullable();
            
            //Adviser
            $table->string('adviser_name')->nullable();
            $table->string('adviser_email')->nullable();
            //President
            $table->string('president_studno')->nullable();
            $table->string('president_name')->nullable();
            $table->string('president_email')->nullable();
            $table->mediumText('comments')->nullable();
            //About Us
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petition');
    }
};
