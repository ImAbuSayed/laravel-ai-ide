<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laravel_prompts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('prompt_text');
            $table->string('category');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laravel_prompts');
    }
};
