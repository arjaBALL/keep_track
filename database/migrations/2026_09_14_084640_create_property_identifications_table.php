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
            $table->string('ics_par_no');
            $table->date('ics_par_date');
            $table->string('engas_old_property_no');
            $table->string('old_property_no');
            $table->string('new_property_no');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_identifications');
    }
};
