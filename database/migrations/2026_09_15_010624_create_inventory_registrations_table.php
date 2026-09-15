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
            $table->integer('classification_id');
            $table->integer('identification_id');
            $table->integer('description_id');
            $table->integer('valuation_id');
            $table->integer('accountability_id');
            $table->integer('location_id');
            $table->integer('status_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_registrations');
    }
};
