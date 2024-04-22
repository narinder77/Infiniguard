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
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->foreignId('client_provider_id')->constrained('certified_providers','provider_id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('client_company_name', 150)->nullable();
            $table->string('client_firstname', 50);
            $table->string('client_lastname', 50)->nullable();
            $table->string('client_email', 150);
            $table->string('client_phone', 100);
            $table->string('client_password', 100);
            $table->enum('client_status', ['0', '1'])->default('1')->comment('1=>active,0=>inactive');
            $table->integer('client_otp')->nullable();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
