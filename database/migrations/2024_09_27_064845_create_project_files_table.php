<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laravel_project_id')->constrained('laravel_projects')->onDelete('cascade');
            $table->string('file_path');
            $table->longText('content');
            $table->enum('file_type', ['php', 'blade', 'js', 'css', 'json', 'env', 'other']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_files');
    }
};
