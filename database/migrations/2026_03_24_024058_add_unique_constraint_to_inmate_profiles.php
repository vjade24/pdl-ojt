<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inmate_profiles', function (Blueprint $table) {
            $table->unique([
                'firstname',
                'lastname',
                'middlename',
                'birthdate'
            ], 'unique_inmate_identity');
        });
    }

    public function down(): void
    {
        Schema::table('inmate_profiles', function (Blueprint $table) {
            $table->dropUnique('unique_inmate_identity');
        });
    }
};
