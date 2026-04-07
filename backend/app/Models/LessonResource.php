<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'resource_type',
        'media_id',
        'external_url',
    ];

    public function lesson() : BelongsTo { return $this->belongsTo(Lesson::class); }
    public function media() : BelongsTo { return $this->belongsTo(Media::class); }

}
