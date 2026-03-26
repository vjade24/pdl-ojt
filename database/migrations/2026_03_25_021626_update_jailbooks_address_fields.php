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
        Schema::table('jailbooks', function (Blueprint $table) {

         
            $table->dropForeign(['add_province_id']);
            $table->dropForeign(['add_municipality_id']);
            $table->dropForeign(['add_barangay_id']);

         
            $table->dropColumn([
                'add_province_id',
                'add_municipality_id',
                'add_barangay_id',
            ]);

          
            $table->string('add_province_name')->nullable()->after('inmate_profile_id');
            $table->string('add_municipality_name')->nullable();
            $table->string('add_barangay_name')->nullable();
        });
    }

   
    public function down(): void
    {
        Schema::table('jailbooks', function (Blueprint $table) {

            // 🔄 Restore old columns
            $table->foreignId('add_province_id')->constrained('provinces')->cascadeOnDelete();
            $table->foreignId('add_municipality_id')->constrained('municipalities')->cascadeOnDelete();
            $table->foreignId('add_barangay_id')->constrained('barangays')->cascadeOnDelete();

            // ❌ Remove snapshot fields
            $table->dropColumn([
                'add_province_name',
                'add_municipality_name',
                'add_barangay_name',
            ]);
        });
    }
};