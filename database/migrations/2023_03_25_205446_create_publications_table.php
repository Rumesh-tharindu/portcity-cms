<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->json('title');
            $table->string('source')->nullable();
            $table->json('summary');
            $table->json('description');
            $table->date('published_at')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
};
