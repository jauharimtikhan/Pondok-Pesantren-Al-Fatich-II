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
        Schema::create('wakafs', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->longText('description');
            $table->text('benefit')->nullable();
            $table->string('target');
            $table->string('last_amount')->nullable();
            $table->string('link');
            $table->string('image');
            $table->dateTime('expire_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakafs');
    }
};
