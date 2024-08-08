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
        Schema::table('student_organizations', function (Blueprint $table) {
            $table->string('org1_memberstatus')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_organizations', function (Blueprint $table) {
            $table->string('org1_memberstatus')->nullable(false)->change();
        });
    }
};
