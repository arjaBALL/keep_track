<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('classification_id')->nullable();
            $table->integer('identification_id')->nullable();
            $table->integer('description_id')->nullable();
            $table->integer('valuation_id')->nullable();
            $table->integer('accountability_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('status_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_registrations');
    }
};