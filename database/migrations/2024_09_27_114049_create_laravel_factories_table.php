<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laravel_factories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laravel_project_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->longText('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laravel_factories');
    }
};
