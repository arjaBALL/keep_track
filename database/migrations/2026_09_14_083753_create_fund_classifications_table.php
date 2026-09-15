<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_classifications', function (Blueprint $table) {
            $table->id();
            $table->integer('fund_id');
            $table->integer('account_id');
            $table->integer('property_class_id');
            $table->integer('property_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_classifications');
    }
};
