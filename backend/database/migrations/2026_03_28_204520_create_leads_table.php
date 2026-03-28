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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->foreignId('interest_program_id')->nullable()->constrained('programs')->nullOnDelete();
            $table->string('source', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 30)->default('new');
            $table->timestamps();

            $table->index('phone');
            $table->index('source');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
