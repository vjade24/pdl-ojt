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
        Schema::create('inmate_profiles', function (Blueprint $table) {
            $table->id();

     
            $table->string('pdl_number')->unique();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->date('birthdate');
            $table->string('sex');
            $table->string('civil_status');

         
            $table->string('place_of_birth')->nullable();

            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('complexion')->nullable();

      
            $table->foreignId('religion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ethnicity_id')->constrained()->cascadeOnDelete();

        

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmate_profiles');
    }
};