<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faq_links', function (Blueprint $table) {
            $table->id();

            $table->foreignId('faq_id')
                ->constrained('faqs')
                ->cascadeOnDelete();

            $table->json('label');

            $table->string('route_name');

            $table->unsignedInteger('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faq_links');
    }
};
