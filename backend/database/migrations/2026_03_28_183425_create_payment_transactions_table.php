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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('billing_period_id')->nullable()->constrained('enrollment_billing_periods')->nullOnDelete();
            $table->foreignId('initiated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('recorded_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('payment_method', 30);   // bank_card, mobile_money, cash
            $table->string('payment_channel', 30);  // online, physical_office, admin_backoffice
            $table->string('provider', 50)->nullable();
            $table->string('transaction_reference')->nullable();
            $table->string('external_reference')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('USD');
            $table->string('status', 30)->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->json('metadata')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('payment_method');
            $table->index('payment_channel');
            $table->index('provider');
            $table->index('status');
            $table->unique('transaction_reference');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
