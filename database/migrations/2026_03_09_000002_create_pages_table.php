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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('meta_title', 200);
            $table->string('hero_title', 255)->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image', 500)->nullable();
            $table->string('hero_btn_primary_text', 100)->nullable();
            $table->string('hero_btn_primary_url', 300)->nullable();
            $table->string('hero_btn_secondary_text', 100)->nullable();
            $table->string('hero_btn_secondary_url', 300)->nullable();
            $table->string('section_title', 255)->nullable();
            $table->text('section_subtitle')->nullable();
            $table->string('cta_title', 255)->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_btn_text', 100)->nullable();
            $table->longText('body_content')->nullable();
            // Kolom khusus untuk halaman /about
            $table->string('vision_title', 200)->nullable();
            $table->text('vision_content')->nullable();
            $table->string('mission_title', 200)->nullable();
            $table->string('story_title', 200)->nullable();
            $table->longText('story_content')->nullable();
            $table->string('team_section_title', 200)->nullable();
            $table->text('team_section_subtitle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
