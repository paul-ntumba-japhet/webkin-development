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
        Schema::create('enrollment_billing_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('period_number');
            $table->string('label', 100);
            $table->date('period_start_date');
            $table->date('period_end_date');
            $table->date('due_date');
            $table->decimal('amount_due', 12, 2);
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('balance_due', 12, 2);
            $table->string('status', 30)->default('pending');
            $table->boolean('is_initial_payment')->default(false);
            $table->timestamps();

            $table->unique(['enrollment_id', 'period_number']);
            $table->index('due_date');
            $table->index('status');
            $table->index('is_initial_payment');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment_billing_periods');
    }
};
