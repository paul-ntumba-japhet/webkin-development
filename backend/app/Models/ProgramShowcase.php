<?php

namespace App\Models;

use App\Domain\Programs\Enums\ProgramShowcaseStatus;
use App\Domain\Programs\Enums\ProgramShowcaseType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramShowcase extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'type',
        'title',
        'description',
        'media_id',
        'external_url',
        'thumbnail_media_id',
        'position',
        'is_featured',
        'status',
    ];

    protected function casts() : array
    {
        return [
            'program_id' => 'integer',
            'media_id' => 'integer',
            'thumbnail_media_id' => 'integer',
            'position' => 'integer',
            'is_featured' => 'boolean',
            'type' => ProgramShowcaseType::class,
            'status' => ProgramShowcaseStatus::class,
        ];
    }

    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function media() : BelongsTo { return $this->belongsTo(Media::class); }
    public function thumbnailMedia() : BelongsTo { return $this->belongsTo(Media::class, 'thumbnail_media_id'); }

}
