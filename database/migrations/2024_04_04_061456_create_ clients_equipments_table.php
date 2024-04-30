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
        Schema::create('client_equipments', function (Blueprint $table) {
            $table->id('client_equipment_id');
            $table->foreignId('equipment_qr_id')->constrained('generated_qr_codes','equipment_qr_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_id')->nullable()->constrained('clients','client_id')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('client_maintenance_reminder')->default(1);
            $table->tinyInteger('client_reminder_days')->default(90);
            $table->enum('client_reminder_language', ['1', '2'])->default('1')->comment('1=>english,2=>spanish');
            $table->json('client_additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_equipments');
    }
};
