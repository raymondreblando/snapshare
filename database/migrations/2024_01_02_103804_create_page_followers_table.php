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
        Schema::create('page_followers', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('page_id');
            $table->foreignUuid('user_id');
            $table->timestamps();

            $table->foreign('page_id')->references('page_id')->on('pages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_followers');
    }
};
