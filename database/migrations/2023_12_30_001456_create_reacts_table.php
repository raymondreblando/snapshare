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
        Schema::create('reacts', function (Blueprint $table) {
            $table->uuid('react_id')->primary();
            $table->foreignUuid('snap_id');
            $table->foreignUuid('user_id');
            $table->timestamps();

            $table->foreign('snap_id')->references('snap_id')->on('snaps')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reacts');
    }
};
