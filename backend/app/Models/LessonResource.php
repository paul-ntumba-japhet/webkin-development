<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Curriculum\Enums\LessonResourceType;

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

    protected function casts(): array
    {
        return [
            'lesson_id' => 'integer',
            'media_id' => 'integer',
            'resource_type' => LessonResourceType::class,
        ];
    }

    public function lesson() : BelongsTo { return $this->belongsTo(Lesson::class); }
    public function media() : BelongsTo { return $this->belongsTo(Media::class); }

}
