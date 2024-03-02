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
        Schema::create('paket_wakafs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('price');
            $table->integer('multiple_price');
            $table->string('wakaf_id')->references('id')->on('wakafs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wakafs');
    }
};
