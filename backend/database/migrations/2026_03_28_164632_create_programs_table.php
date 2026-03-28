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
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('long_description')->nullable();
            $table->longText('curriculum_summary')->nullable();
            $table->unsignedInteger('duration_value');
            $table->string('duration_unit', 20)->default('months');
            $table->longText('professional_outcomes')->nullable();
            $table->string('status', 30)->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->foreignId('cover_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->timestamps();

            $table->index('status');
            $table->index('is_featured');
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
