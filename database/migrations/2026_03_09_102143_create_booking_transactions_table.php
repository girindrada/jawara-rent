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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_space_id')->constrained('office_spaces')->cascadeOnDelete();
            $table->string('name');
            $table->string('phone_number');
            $table->string('booking_trx_id')->unique();
            $table->integer('total_amount');
            $table->integer('duration');
            $table->date('started_at');
            $table->date('ended_at');
            $table->boolean('is_paid')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
