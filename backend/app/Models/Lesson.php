<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function module() { return $this->belongsTo(ProgramModule::class, 'module_id'); }
    public function resources() { return $this->hasMany(LessonResource::class); }
    public function schedules() { return $this->hasMany(CohortSchedule::class); }
    public function progressEntries() { return $this->hasMany(StudentProgress::class); }
    public function assignments() { return $this->hasMany(Assignment::class); }


}
