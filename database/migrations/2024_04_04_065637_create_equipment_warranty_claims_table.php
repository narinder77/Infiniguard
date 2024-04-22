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
        Schema::create('equipment_warranty_claims', function (Blueprint $table) {
            $table->id('equipment_claim_id');
            $table->enum('equipment_claim_status', ['0', '1'])->default('0')->comment('0=>unanswered,1=>answered');
            $table->string('equipment_claim_name', 150)->nullable();
            $table->string('equipment_claim_email', 150)->nullable();
            $table->string('equipment_claim_phone_number', 100)->nullable();
            $table->foreignId('equipment_claim_qr_id')->constrained('generated_qr_codes','equipment_qr_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('equipment_claim_inspection_id')->constrained('equipment_inspections','inspection_id')->onDelete('cascade')->onUpdate('cascade');
            $table->date('equipment_claim_date')->nullable();
            $table->text('equipment_claim_notes')->nullable();
            $table->string('equipment_claim_address', 250)->nullable();
            $table->string('equipment_claim_latitude', 100)->nullable();
            $table->string('equipment_claim_longitude', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_warranty_claims');
    }
};
