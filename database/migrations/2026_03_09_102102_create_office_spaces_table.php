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
        Schema::create('office_spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->text('about')->nullable();
            $table->boolean('is_open')->default(true);
            $table->boolean('is_full_booked')->default(false);
            $table->integer('price');
            $table->integer('duration');
            $table->string('address');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_spaces');
    }
};
