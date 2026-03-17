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
    Schema::create('release_orders', function (Blueprint $table) {
        $table->id();

        $table->foreignId('jailbook_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('court_order_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->date('release_date');

        $table->string('release_reason')->nullable();
        $table->text('remarks')->nullable();

        $table->string('received_by')->nullable();
        $table->string('approved_by')->nullable();

        $table->string('status')->default('Pending');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_orders');
    }
};
