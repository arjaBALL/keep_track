<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('description_acquisitions', function (Blueprint $table) {
            $table->id();
            $table->date('acquisition_date');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('description');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('description_acquisitions');
    }
};
