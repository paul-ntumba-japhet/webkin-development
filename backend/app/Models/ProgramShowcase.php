<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function program() { return $this->belongsTo(Program::class); }
    public function media() { return $this->belongsTo(Media::class); }
    public function thumbnailMedia() { return $this->belongsTo(Media::class, 'thumbnail_media_id'); }

}
