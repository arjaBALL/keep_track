<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accountability_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('status_id');
            $table->date('are_on');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accountability_statuses');
    }
};
