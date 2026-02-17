<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->json('company');
            $table->json('role');
            $table->json('location')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->json('description_html')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('experiences'); }
};
