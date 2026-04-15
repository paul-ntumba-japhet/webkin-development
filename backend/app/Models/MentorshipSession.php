<?php

namespace App\Models;

use App\Domain\Mentoring\Enums\MentorshipMode;
use App\Domain\Mentoring\Enums\MentorshipStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorshipSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'mentor_id',
        'student_id',
        'enrollment_id',
        'title',
        'topic',
        'session_datetime',
        'duration_minutes',
        'mode',
        'status',
        'notes',
    ];

    protected function casts() : array
    {
        return [
            'mentor_id' => 'integer',
            'student_id' => 'integer',
            'enrollment_id' => 'integer',
            'session_datetime' => 'datetime',
            'duration_minutes' => 'integer',
            'mode' => MentorshipMode::class,
            'status' => MentorshipStatus::class,
        ];
    }

    public function mentor() : BelongsTo { return $this->belongsTo(User::class, 'mentor_id'); }
    public function student() : BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }

}
