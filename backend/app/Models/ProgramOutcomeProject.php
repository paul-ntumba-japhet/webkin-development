<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Curriculum\Enums\ProgramOutcomeProjectStatus;

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

    protected function casts() : array
    {
        return [
            'program_id' => 'integer',
            'thumbnail_media_id' => 'integer',
            'position' => 'integer',
            'is_featured' => 'boolean',
            'status' => ProgramOutcomeProjectStatus::class,
        ];
    }


    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function thumbnailMedia() : BelongsTo { return $this->belongsTo(Media::class, 'thumbnail_media_id'); }
}
