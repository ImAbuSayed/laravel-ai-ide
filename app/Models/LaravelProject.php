<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaravelProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'use_authentication',
        'use_api',
        'use_admin_panel',
        'github_url',
        'database_design',
        'features',
    ];

    protected $casts = [
        'use_authentication' => 'boolean',
        'use_api' => 'boolean',
        'use_admin_panel' => 'boolean',
        'features' => 'array',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class, 'laravel_project_id');
    }

    public function aiPrompts(): HasMany
    {
        return $this->hasMany(AiPrompt::class, 'laravel_project_id');
    }

    public function models(): HasMany
    {
        return $this->hasMany(LaravelModel::class);
    }

    public function migrations(): HasMany
    {
        return $this->hasMany(LaravelMigration::class);
    }

    public function controllers(): HasMany
    {
        return $this->hasMany(LaravelController::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(LaravelView::class);
    }

    public function factories(): HasMany
    {
        return $this->hasMany(LaravelFactory::class);
    }

    public function seeders(): HasMany
    {
        return $this->hasMany(LaravelSeeder::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(LaravelRule::class);
    }

    public function mails(): HasMany
    {
        return $this->hasMany(LaravelMail::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(LaravelNotification::class);
    }
}