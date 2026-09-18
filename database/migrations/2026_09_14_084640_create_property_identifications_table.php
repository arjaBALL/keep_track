<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_identifications', function (Blueprint $table) {
            $table->id();

            $table->string('ics_par_no')->nullable();
            $table->date('ics_par_date')->nullable();
            $table->string('engas_old_property_no')->nullable();
            $table->string('old_property_no')->nullable();
            $table->string('new_property_no')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_identifications');
    }
};