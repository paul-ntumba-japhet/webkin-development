<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function lesson() { return $this->belongsTo(Lesson::class); }
    public function media() { return $this->belongsTo(Media::class); }

}
