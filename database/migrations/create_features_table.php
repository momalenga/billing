<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create(
            'features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('name');
            $table->bigInteger('price');
            $table->boolean('consumable');
            $table->string('description')->nullable();
        }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
