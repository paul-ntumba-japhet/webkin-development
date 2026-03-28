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
        Schema::create('mentorship_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('topic')->nullable();
            $table->dateTime('session_datetime');
            $table->unsignedInteger('duration_minutes');
            $table->string('mode', 30);
            $table->string('status', 30)->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('session_datetime');
            $table->index('mode');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentorship_sessions');
    }
};
