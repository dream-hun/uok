<?php

declare(strict_types=1);

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
        Schema::create('infrastructure_property', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('infrastructure_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('distance_meters')->nullable();
            $table->unsignedInteger('travel_time_minutes')->nullable();
            $table->string('travel_mode')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['property_id', 'infrastructure_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infrastructure_property');
    }
};
