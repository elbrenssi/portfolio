<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('scene_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('background_mode', ['aurora', 'particles', 'none'])->default('aurora');
            $table->string('hero_model_path')->nullable();
            $table->float('hero_float_speed')->default(0.5);
            $table->float('hero_rotation_speed')->default(0.2);
            $table->float('bloom_intensity')->default(0.3);
            $table->float('ambient_light_intensity')->default(0.5);
            $table->json('section_scene_states')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('scene_settings'); }
};
