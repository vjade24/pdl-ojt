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
        $table->foreignId('jailbook_id')
            ->constrained()
            ->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('fingerprints', function (Blueprint $table) {
        $table->dropForeign(['jailbook_id']);
        $table->dropColumn('jailbook_id');
    });
}
};
