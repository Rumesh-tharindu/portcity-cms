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
        Schema::create('public_registries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->json('title');
            $table->string('license_number')->nullable();
            $table->json('address');
            $table->json('description');
            $table->string('status');
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('public_registries');
    }
};
