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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('short_description', 500);
            $table->text('full_description')->nullable();
            $table->string('image', 500)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('target_audience', 200)->nullable();
            $table->string('location', 200)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
