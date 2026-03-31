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
    Schema::create('jailbooks', function (Blueprint $table) {
        $table->id();

        
        $table->foreignId('court_order_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('inmate_profile_id')->constrained()->cascadeOnDelete();

        $table->foreignId('add_province_id')->constrained('provinces')->cascadeOnDelete();
        $table->foreignId('add_municipality_id')->constrained('municipalities')->cascadeOnDelete();
        $table->foreignId('add_barangay_id')->constrained('barangays')->cascadeOnDelete();

        $table->foreignId('court_id')->constrained()->cascadeOnDelete();
        $table->foreignId('judge_id')->constrained()->cascadeOnDelete();
        $table->foreignId('station_id')->constrained()->cascadeOnDelete();
        $table->foreignId('offense_id')->constrained()->cascadeOnDelete();

     
        $table->string('case_no');
        $table->string('address')->nullable();

       
        $table->string('civilStatus')->nullable();
        $table->string('height')->nullable();
        $table->string('weight')->nullable();
        $table->string('hair')->nullable();
        $table->string('alias')->nullable();
        $table->string('complexion')->nullable();
        $table->string('occupation')->nullable();

        $table->boolean('father_decease_tag')->default(false);
        $table->boolean('mother_decease_tag')->default(false);

        $table->string('wife_husb_name')->nullable();
        $table->string('wife_husb_add')->nullable();
        $table->string('educ_attainment')->nullable();
        $table->string('place_visited')->nullable();

     
        $table->dateTime('date_received')->nullable();
        $table->string('endorsing_officer')->nullable();
        $table->text('circum_arrest')->nullable();
        $table->text('confiscated')->nullable();
        $table->text('completion')->nullable();
        $table->string('receiving_officer')->nullable();
        $table->string('chief_admin')->nullable();
        $table->string('prov_warden')->nullable();

        $table->date('detention_from')->nullable();
        $table->date('detention_to')->nullable();
        $table->string('status')->default('Detained');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jailbooks');
    }
};
