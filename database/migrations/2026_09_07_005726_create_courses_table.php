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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Especialização');
            $table->string('modality')->default('Presencial');
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('duration_workload')->nullable();
            $table->string('schedule_info')->nullable();
            $table->text('target_audience')->nullable();
            $table->longText('syllabus')->nullable();
            $table->string('investment')->nullable();
            $table->string('coordinator')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
