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
    Schema::table('fingerprints', function (Blueprint $table) {
        $table->dropForeign(['inmate_profile_id']); // if exists
        $table->dropColumn('inmate_profile_id');
    });
    }

    public function down(): void
    {
    Schema::table('fingerprints', function (Blueprint $table) {
        $table->foreignId('inmate_profile_id')->constrained();
    });
    }
    };
