<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('strategic_areas', function (Blueprint $table) {
            $table->id();

            $table->json('title');
            $table->json('description');
            $table->string('icon')->default('heroicon-o-flag');
            $table->unsignedInteger('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('strategic_areas');
    }
};
