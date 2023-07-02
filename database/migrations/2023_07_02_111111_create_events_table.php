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
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->json('title');
            $table->json('location');
            $table->json('ticket');
            $table->json('description');
            $table->string('slug')->nullable();
            $table->boolean('one_day')->default(false);
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
        Schema::dropIfExists('events');
    }
};
