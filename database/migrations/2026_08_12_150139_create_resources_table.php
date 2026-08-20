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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();

            $table->json('title');
            $table->json('description');
            $table->string('file_path');
            $table->string('access_level')->default('public');
            $table->boolean('is_publication')->default(false);
            $table->string('author')->nullable();
            $table->string('publish_year')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('downloads_count')->default(0);
            $table->foreignId('category_id')->constrained('resource_categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
