<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaravelMigration extends Model
{
    use HasFactory;

    protected $fillable = ['laravel_project_id', 'name', 'content'];

    public function laravelProject(): BelongsTo
    {
        return $this->belongsTo(LaravelProject::class);
    }
}
