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
    Schema::create('court_orders', function (Blueprint $table) {
        $table->id();

        $table->string('case_no');
        $table->string('order_category');
        $table->date('order_date');
        $table->dateTime('receive_date')->nullable();

        $table->string('receive_by')->nullable();
        $table->string('approved_by')->nullable();
        $table->dateTime('approved_date')->nullable();

        $table->string('order_no')->nullable();
        $table->json('attachment')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_orders');
    }
};
