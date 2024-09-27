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
    ];

    protected $casts = [
        'use_authentication' => 'boolean',
        'use_api' => 'boolean',
        'use_admin_panel' => 'boolean',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class, 'laravel_project_id');
    }

    public function aiPrompts(): HasMany
    {
        return $this->hasMany(AiPrompt::class, 'laravel_project_id');
    }
}
