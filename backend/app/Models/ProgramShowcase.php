<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function media() : BelongsTo { return $this->belongsTo(Media::class); }
    public function thumbnailMedia() : BelongsTo { return $this->belongsTo(Media::class, 'thumbnail_media_id'); }

}
