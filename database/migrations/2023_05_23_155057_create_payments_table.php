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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('code')->unique();
            $table->string('icon')->nullable();
            $table->text('url');
            $table->text('mode')->default(false);
            $table->json('sandbox')->nullable();
            $table->json('live')->nullable();
            $table->boolean('default')->default(false);
            $table->boolean('web_status')->default(false);
            $table->boolean('api_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
