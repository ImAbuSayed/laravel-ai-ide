<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = ['laravel_project_id', 'file_path', 'content', 'file_type'];

    public function laravelProject(): BelongsTo
    {
        return $this->belongsTo(LaravelProject::class, 'laravel_project_id');
    }
}
