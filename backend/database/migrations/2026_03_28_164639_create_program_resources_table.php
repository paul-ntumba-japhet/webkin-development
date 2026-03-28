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
        Schema::create('program_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('resource_type', 50);
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('external_url')->nullable();
            $table->unsignedInteger('position')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->string('status', 30)->default('draft');
            $table->timestamps();

            $table->index('resource_type');
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
        Schema::dropIfExists('program_resources');
    }
};
