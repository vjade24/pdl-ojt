<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('identified_marks', function (Blueprint $table) {
            $table->string('marked_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('identified_marks', function (Blueprint $table) {
            $table->dropColumn('marked_image');
        });
    }
};
