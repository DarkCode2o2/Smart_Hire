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
        Schema::create('cv_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_file_id')->constrained('cv_files')->onDelete('cascade');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->json('skills')->nullable();
            $table->string('education')->nullable();
            $table->text('ai_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_summaries');
    }
};
