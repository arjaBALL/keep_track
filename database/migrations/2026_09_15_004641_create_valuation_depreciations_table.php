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
            $table->integer('estimated_life');
            $table->decimal('unit_value');
            $table->decimal('salvage_value');
            $table->decimal('monthly_depreciation');
            $table->integer('month_id');
            $table->decimal('accumulated_depreciation');
            $table->decimal('net_book_value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valuation_depreciations');
    }
};
