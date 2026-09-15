<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_conditions', function (Blueprint $table) {
            $table->id();
            $table->integer('location_id');
            $table->string('condition_of_ppe');
            $table->text('remarks');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_conditions');
    }
};
