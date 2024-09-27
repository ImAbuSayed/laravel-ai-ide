<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaravelPrompt extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'prompt_text', 'category'];
}
