<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('responsibility_centers', function (Blueprint $table) {
            $table->id();
            $table->string('responsibility_center_name')->nullable();          
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responsibility_centers');
    }
};