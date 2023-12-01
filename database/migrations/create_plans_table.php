<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create(
            'plans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->string('name');
                $table->bigInteger('price');
                $table->integer('duration');
                $table->integer('max_seats');
                $table->string('tagline')->nullable();
            }
        );

    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
