<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();

            $table->json('question');
            $table->json('answer');

            // This is the actual relationship: constrained() looks at the column name
            // ("category_id"), strips the "_id", pluralizes what's left ("category" ->
            // "categories"), and assumes that's the table to link to — so this one line
            // is Laravel's shorthand for "category_id references faq_categories.id."
            $table->foreignId('category_id')->constrained('faq_categories')->cascadeOnDelete();

            // A plain integer used purely for manual sort order — lets staff drag FAQ
            // entries into whatever order makes sense within a category (most-asked
            // question first, etc.), independent of when each one was created.
            $table->unsignedInteger('order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
