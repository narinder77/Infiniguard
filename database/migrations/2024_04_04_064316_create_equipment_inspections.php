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
        Schema::create('equipment_inspections', function (Blueprint $table) {
            $table->id('inspection_id');
            $table->foreignId('inspection_equipment_qr_id')->constrained('generated_qr_codes','equipment_qr_id')->onDelete('cascade')->onUpdate('cascade');
            $table->json('inspection_condenser_image')->nullable();
            $table->json('inspection_cabinet_image')->nullable();
            $table->json('inspection_evaporator_image')->nullable();
            $table->json('inspection_additional_image')->nullable();
            $table->string('inspection_address', 200)->nullable();
            $table->text('inspection_notes')->nullable();
            $table->string('inspection_latitude', 100)->nullable();
            $table->string('inspection_longitude', 100)->nullable();
            $table->date('inspection_reminder_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_inspections');
    }
};
