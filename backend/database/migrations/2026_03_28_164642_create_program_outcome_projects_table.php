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
        Schema::create('program_outcome_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('stack_summary')->nullable();
            $table->string('difficulty_level', 50)->nullable();
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->foreignId('thumbnail_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->unsignedInteger('position')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->string('status', 30)->default('draft');
            $table->timestamps();

            $table->index(['program_id', 'position']);
            $table->index('status');
            $table->index('is_featured');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_outcome_projects');
    }
};
