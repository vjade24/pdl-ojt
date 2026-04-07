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
        Schema::table('identified_marks', function (Blueprint $table) {
            
            $table->json('mark_details')->nullable()->after('marked_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identified_marks', function (Blueprint $table) {
            $table->dropColumn('mark_details');
        });
    }
};