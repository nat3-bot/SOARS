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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('organization_name');
            $table->string('activity_title');
            $table->string('type_of_activity');
            $table->date('activity_start_date')->nullable();
            $table->date('activity_end_date')->nullable();
            $table->time('activity_start_time')->nullable();
            $table->time('activity_end_time')->nullable();
            $table->string('venue')->nullable();
            $table->integer('participants')->nullable();
            $table->mediumText('partner_organization')->nullable();
            $table->integer('organization_fund')->nullable();
            $table->integer('solidarity_share')->nullable();
            $table->integer('registration_fee')->nullable();
            $table->integer('AUSG_subsidy')->nullable();
            $table->longText('sponsored_by')->nullable();
            $table->integer('ticket_selling')->nullable();
            $table->integer('ticket_control_number')->nullable();
            $table->longText('other_source_of_fund')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
