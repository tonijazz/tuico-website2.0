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
        Schema::create('events', function (Blueprint $table) {

            $table->id();
            $table->json('title');
            $table->json('description');
            $table->string('location');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->string('banner_image')->nullable();
            $table->foreignId('governance_meeting_id')->nullable()->constrained('governance_meetings')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
