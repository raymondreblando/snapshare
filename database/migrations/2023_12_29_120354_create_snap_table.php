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
        Schema::create('snaps', function (Blueprint $table) {
            $table->uuid('snap_id')->primary();
            $table->string('snap_caption', 500);
            $table->string('snap_privacy', 30);
            $table->uuidMorphs('snapable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snap');
    }
};
