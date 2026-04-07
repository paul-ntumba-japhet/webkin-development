<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'summary',
        'content',
        'lesson_type',
        'is_preview',
        'position',
        'published_at',
    ];

    public function module() : BelongsTo { return $this->belongsTo(ProgramModule::class, 'module_id'); }
    public function resources() : HasMany { return $this->hasMany(LessonResource::class); }
    public function schedules() : HasMany { return $this->hasMany(CohortSchedule::class); }
    public function progressEntries() : HasMany { return $this->hasMany(StudentProgress::class); }
    public function assignments() : HasMany { return $this->hasMany(Assignment::class); }


}
