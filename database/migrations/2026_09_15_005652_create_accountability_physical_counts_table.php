<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accountability_physical_counts', function (Blueprint $table) {
            $table->id();
            $table->integer('balance_per_card')->nullable();
            $table->integer('on_hand_per_count')->nullable();
            $table->integer('responsibility_center_id')->nullable();
            $table->integer('accountable_officer_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accountability_physical_counts');
    }
};