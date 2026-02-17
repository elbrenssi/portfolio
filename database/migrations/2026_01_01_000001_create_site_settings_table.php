<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->json('site_name');
            $table->json('tagline')->nullable();
            $table->json('hero_headline')->nullable();
            $table->json('hero_subheadline')->nullable();
            $table->string('primary_email')->nullable();
            $table->json('location')->nullable();
            $table->string('canonical_base_url')->nullable();
            $table->json('seo_title_default')->nullable();
            $table->json('seo_description_default')->nullable();
            $table->string('seo_image_default')->nullable();
            $table->boolean('robots_index')->default(true);
            $table->boolean('robots_follow')->default(true);
            $table->json('social_links')->nullable();
            $table->string('theme_default')->default('dark');
            $table->boolean('effects_enabled')->default(true);
            $table->unsignedTinyInteger('effects_intensity')->default(60);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
