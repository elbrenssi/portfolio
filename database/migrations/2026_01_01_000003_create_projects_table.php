<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('long_description_html')->nullable();
            $table->json('tech_stack')->nullable();
            $table->string('role')->nullable();
            $table->string('year')->nullable();
            $table->string('client')->nullable();
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('cover_image_path')->nullable();
            $table->string('model_gltf_path')->nullable();
            $table->float('model_scale')->default(1);
            $table->json('model_position')->nullable();
            $table->json('model_rotation')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
