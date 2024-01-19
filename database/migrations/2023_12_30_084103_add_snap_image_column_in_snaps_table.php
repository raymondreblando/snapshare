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
        Schema::table('snaps', function (Blueprint $table) {
            $table->string('snap_caption', 1000)->nullable()->change();
            $table->string('snap_image', 1000)->nullable()->after('snap_privacy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('snaps', function (Blueprint $table) {
            $table->string('snap_caption', 1000)->nullable(false)->change();
            $table->dropColumn('snap_image');
        });
    }
};
