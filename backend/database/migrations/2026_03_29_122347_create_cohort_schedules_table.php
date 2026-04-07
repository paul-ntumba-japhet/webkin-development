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
        Schema::create('cohort_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cohort_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cohort_weekly_schedule_id')->nullable()->constrained('cohort_weekly_schedules')->nullOnDelete();
            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('module_id')->nullable()->constrained('program_modules')->nullOnDelete();
            $table->foreignId('lesson_id')->nullable()->constrained('lessons')->nullOnDelete();
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
            $table->date('scheduled_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('session_type')->default('course');
            $table->string('status')->default('scheduled');
            $table->text('title')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['cohort_id', 'scheduled_date']);
            $table->index(['instructor_id', 'scheduled_date']);
            $table->index(['room_id', 'scheduled_date']);
            $table->index('status');

            // Évite les doublons évidents
            $table->unique(
                ['cohort_id', 'scheduled_date', 'start_time'],
                'cohort_schedule_unique_session'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cohort_schedules');
    }
};
