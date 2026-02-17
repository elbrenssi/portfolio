<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('tagline')->nullable();
            $table->string('hero_headline');
            $table->text('hero_subheadline')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('location')->nullable();
            $table->string('seo_title_default')->nullable();
            $table->text('seo_description_default')->nullable();
            $table->string('seo_image_default')->nullable();
            $table->string('canonical_base_url');
            $table->boolean('robots_index')->default(true);
            $table->boolean('robots_follow')->default(true);
            $table->json('social_links')->nullable();
            $table->boolean('effects_enabled')->default(true);
            $table->unsignedTinyInteger('effects_intensity')->default(60);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};
