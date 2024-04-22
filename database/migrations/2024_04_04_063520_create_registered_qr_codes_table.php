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
        Schema::create('registered_qr_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_qr_id')->constrained('generated_qr_codes','equipment_qr_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('applicator_id')->constrained('certified_applicators','applicator_id')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('condenser', ['0', '1'])->default('0')->comment('1=>yes,0=>no');
            $table->enum('cabinet', ['0', '1'])->default('0')->comment('1=>yes,0=>no');
            $table->enum('evaporator', ['0', '1'])->default('0')->comment('1=>yes,0=>no');
            $table->string('model_number_image', 150)->nullable();
            $table->string('serial_number_image', 150)->nullable();
            $table->string('distant_image', 150)->nullable();
            $table->json('additional_image')->nullable();
            $table->string('equipment_type', 50)->nullable();
            $table->text('notes')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_qr_codes');
    }
};
