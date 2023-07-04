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
        Schema::create('custom_table_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_table_id')->nullable()->index()
            ->constrained()
            ->cascadeOnDelete();
            $table->json('th');
            $table->json('td');
            $table->string('slug')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_table_summaries');
    }
};
