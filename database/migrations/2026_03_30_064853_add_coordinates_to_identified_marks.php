<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('identified_marks', function (Blueprint $table) {
            $table->string('view_type')->nullable(); // front, back, left, right
            $table->float('x_position')->nullable();
            $table->float('y_position')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('identified_marks', function (Blueprint $table) {
            $table->dropColumn(['view_type', 'x_position', 'y_position']);
        });
    }
};