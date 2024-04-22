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
        Schema::create('generated_qr_codes', function (Blueprint $table) {  
            $table->id('equipment_qr_id');
            $table->string('equipment_qr_number',50)->nullable();
            $table->string('equipment_model_number', 100)->nullable();
            $table->string('equipment_serial_number', 100)->nullable();                 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_qr_codes');
    }
};
