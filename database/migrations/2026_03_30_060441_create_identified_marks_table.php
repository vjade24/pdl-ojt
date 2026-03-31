<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('identified_marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jailbook_id')->constrained()->cascadeOnDelete();
            $table->string('marks');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identified_marks');
    }
};
