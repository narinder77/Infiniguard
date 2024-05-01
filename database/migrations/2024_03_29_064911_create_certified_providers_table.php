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
        Schema::create('certified_providers', function (Blueprint $table) {
            $table->id('provider_id');
            $table->enum('provider_type', ['1', '2'])->default('2')->comment('1=admin, 2=provider');
            $table->string('provider_administrator', 100)->nullable();
            $table->string('provider_name', 150)->nullable();
            $table->string('provider_logo_image', 150)->nullable();
            $table->string('provider_profile_image', 150);
            $table->string('provider_email', 150);
            $table->string('provider_phone', 100)->nullable();
            $table->string('provider_password', 100);
            $table->enum('provider_status', ['0', '1'])->default('1')->comment('1=>active, 0=>inactive');
            $table->integer('provider_otp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certified_providers');
    }
};
