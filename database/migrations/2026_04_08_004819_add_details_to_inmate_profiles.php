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
        Schema::table('inmate_profiles', function (Blueprint $table) {
            $table->string('skills')->nullable()->after('place_of_birth');
            $table->string('married_lastname')->nullable()->after('birthdate');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inmate_profiles', function (Blueprint $table) {
            $table->dropColumn([
            'skills',
            'married_lastname'
            ]);
        });
    }
};
