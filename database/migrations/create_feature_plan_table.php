<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'feature_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id');
            $table->foreignId('plan_id');
            $table->float('charges',8,2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feature_plan');
    }
};
