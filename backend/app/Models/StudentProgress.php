<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'progress_percent',
        'completed_at',
        'last_accessed_at',
    ];

    public function enrollment() { return $this->belongsTo(Enrollment::class); }
    public function lesson() { return $this->belongsTo(Lesson::class); }

}
