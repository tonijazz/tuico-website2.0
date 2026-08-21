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
        Schema::create('governance_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('governance_level_id')->constrained('governance_levels')->cascadeOnDelete();
            $table->json('name');
            $table->json('frequency');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governance_meetings');
    }
};
