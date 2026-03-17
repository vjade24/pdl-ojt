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
    Schema::create('fingerprints', function (Blueprint $table) {
        $table->id();

        $table->foreignId('inmate_profile_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->date('fingerprint_date')->nullable();
        $table->string('taken_by')->nullable();
        $table->text('remarks')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fingerprints');
    }
};
