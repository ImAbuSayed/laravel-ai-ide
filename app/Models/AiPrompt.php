<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiPrompt extends Model
{
    use HasFactory;

    protected $fillable = ['laravel_project_id', 'prompt', 'response', 'file_path'];

    public function laravelProject(): BelongsTo
    {
        return $this->belongsTo(LaravelProject::class, 'laravel_project_id');
    }
}
