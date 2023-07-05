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
        Schema::create('custom_tables', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->json('name');
            $table->json('table_data');
            $table->json('table_json');
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
        Schema::dropIfExists('custom_tables');
    }
};
