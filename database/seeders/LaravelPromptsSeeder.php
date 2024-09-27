<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaravelPrompt;

class LaravelPromptsSeeder extends Seeder
{
    public function run()
    {
        $prompts = [
            [
                'name' => 'Generate Model',
                'description' => 'Generate a Laravel model based on migration files',
                'prompt_text' => 'Create a Laravel model for the following migration: {migration_content}',
                'category' => 'models',
            ],
            [
                'name' => 'Generate Migration',
                'description' => 'Generate a Laravel migration based on project features',
                'prompt_text' => 'Create a Laravel migration for a project with the following features: {project_features}',
                'category' => 'migrations',
            ],
            [
                'name' => 'Generate Factory',
                'description' => 'Generate a Laravel factory based on model and migration',
                'prompt_text' => 'Create a Laravel factory for the following model: {model_content} and migration: {migration_content}',
                'category' => 'factories',
            ],
            // Add more prompts as needed
        ];

        foreach ($prompts as $prompt) {
            LaravelPrompt::create($prompt);
        }
    }
}
