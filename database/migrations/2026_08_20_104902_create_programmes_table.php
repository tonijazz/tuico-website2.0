<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();

            $table->json('title');
            $table->json('description');
            $table->string('status')->default('active');
            $table->foreignId('affiliation_id')->nullable()->constrained('affiliations')->nullOnDelete();
            $table->json('outcomes')->nullable();
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
