<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inmate_profiles', function (Blueprint $table) {

            // 🔥 Drop UNIQUE index first
            $table->dropUnique(['pdl_number']);

            // Then drop column
            $table->dropColumn('pdl_number');
        });
    }

    public function down(): void
    {
        Schema::table('inmate_profiles', function (Blueprint $table) {
            $table->string('pdl_number')->nullable();
            $table->unique('pdl_number');
        });
    }
};
