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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained('cohort_schedules')->cascadeOnDelete();
            $table->string('status', 30);
            $table->timestamp('check_in_time')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->unique(['enrollment_id', 'schedule_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
