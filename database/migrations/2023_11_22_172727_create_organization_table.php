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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('requirement_status')->nullable();
            $table->string('name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('type_of_organization')->nullable();
            $table->string('academic_course_based')->nullable();
            $table->string('mission')->nullable();
            $table->string('vision')->nullable();
            $table->string('org_email')->nullable();
            $table->string('org_fb')->nullable();
            $table->mediumText('logo')->nullable();
            $table->mediumText('consti_and_byLaws')->nullable();
            $table->mediumText('letter_of_intent')->nullable();
            $table->string('admin_endorsement')->nullable();
            
            //Adviser
            $table->string('adviser_name')->nullable();
            $table->string('adviser_email')->nullable();
            //AUSG
            $table->string('ausg_rep_studno')->nullable();
            $table->string('ausg_rep_name')->nullable();
            $table->string('ausg_rep_email')->nullable();
            //President
            $table->string('president_studno')->nullable();
            $table->string('president_name')->nullable();
            $table->string('president_email')->nullable();
            //VP Internal
            $table->string('vp_internal_studno')->nullable();
            $table->string('vp_internal_name')->nullable();
            $table->string('vp_internal_email')->nullable();
            //VP external
            $table->string('vp_external_studno')->nullable();
            $table->string('vp_external_name')->nullable();
            $table->string('vp_external_email')->nullable();
            //Secretary
            $table->string('secretary_studno')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('secretary_email')->nullable();
            //Treasurer
            $table->string('treasurer_studno')->nullable();
            $table->string('treasurer_name')->nullable();
            $table->string('treasurer_email')->nullable();
            //Auditor
            $table->string('auditor_studno')->nullable();
            $table->string('auditor_name')->nullable();
            $table->string('auditor_email')->nullable();
            //PRO
            $table->string('pro_studno')->nullable();
            $table->string('pro_name')->nullable();
            $table->string('pro_email')->nullable();
            $table->string('filedBy')->nullable();
            //About Us
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
