<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramOutcomeProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'title',
        'slug',
        'description',
        'stack_summary',
        'difficulty_level',
        'github_url',
        'demo_url',
        'thumbnail_media_id',
        'position',
        'is_featured',
        'status',
    ];
    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function thumbnailMedia() : BelongsTo { return $this->belongsTo(Media::class, 'thumbnail_media_id'); }
}
