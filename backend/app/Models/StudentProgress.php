<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected function casts() : array
    {
        return [
            'enrollment_id' => 'integer',
            'lesson_id' => 'integer',
            'progress_percent' => 'integer',
            'completed_at' => 'datetime',
            'last_accessed_at' => 'datetime',
        ];
    }

    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }
    public function lesson() : BelongsTo { return $this->belongsTo(Lesson::class); }

}
