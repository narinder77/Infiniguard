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
        Schema::create('certified_applicators', function (Blueprint $table) {
            $table->id('applicator_id');
            $table->string('applicator_certification_id', 400);
            $table->foreignId('applicator_provider_id')->constrained('certified_providers','provider_id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('applicator_name', 255);
            $table->string('applicator_email', 255);
            $table->string('applicator_password', 200);
            $table->date('applicator_date')->nullable();
            $table->enum('applicator_language', ['1', '2'])->default('1')->comment('1=>english, 2=>spanish');
            $table->enum('applicator_status', ['0', '1'])->default('1')->comment('1=>active, 0=>inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certified_applicators');
    }
};
