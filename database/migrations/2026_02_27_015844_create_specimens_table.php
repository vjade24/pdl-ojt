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
    Schema::create('specimens', function (Blueprint $table) {
        $table->id();

        $table->foreignId('fingerprint_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('finger_name'); // Left Thumb, Right Index, etc.
        $table->string('fingerprint_image')->nullable();
        $table->text('remarks')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specimens');
    }
};
