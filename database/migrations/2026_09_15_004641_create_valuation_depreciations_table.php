<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('valuation_depreciations', function (Blueprint $table) {
            $table->id();

            $table->integer('estimated_life')->nullable();       
            $table->decimal('unit_value', 12, 2)->nullable();
            $table->decimal('salvage_value', 12, 2)->nullable();
            $table->decimal('monthly_depreciation', 12, 2)->nullable();

            $table->integer('month')->nullable();

            $table->decimal('accumulated_depreciation', 12, 2)->nullable();
            $table->decimal('net_book_value', 12, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valuation_depreciations');
    }
};