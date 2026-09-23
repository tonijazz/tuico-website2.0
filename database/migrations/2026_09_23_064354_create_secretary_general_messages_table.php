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
        Schema::create('secretary_general_messages', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->json('content');

            $table->foreignId('leader_id')
                ->nullable()
                ->constrained('leaders')
                ->nullOnDelete();

            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secretary_general_messages');
    }
};
