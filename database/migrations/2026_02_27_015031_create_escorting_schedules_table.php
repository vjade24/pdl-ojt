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
    Schema::create('escorting_schedules', function (Blueprint $table) {
        $table->id();

        $table->foreignId('jailbook_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('court_order_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

        $table->date('escort_date');
        $table->time('escort_time')->nullable();

        $table->string('destination');
        $table->string('purpose')->nullable();

        $table->string('escorting_officer')->nullable();
        $table->text('remarks')->nullable();

        $table->string('status')->default('Scheduled'); 
        // Scheduled, Completed, Cancelled

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escorting_schedules');
    }
};
