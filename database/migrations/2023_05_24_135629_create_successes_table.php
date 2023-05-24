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
        Schema::create('successes', function (Blueprint $table) {
            $table->id();
            $table->uuid('terminal');
            $table->string('pidx')->nullable();
            $table->string('payment')->nullable();
            $table->string('order')->nullable();
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
            $table->boolean('status')->default(false);
            $table->json('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('successes');
    }
};
