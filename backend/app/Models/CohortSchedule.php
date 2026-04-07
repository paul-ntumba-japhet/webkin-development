<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CohortSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'cohort_id',
        'cohort_weekly_schedule_id',
        'instructor_id',
        'module_id',
        'lesson_id',
        'room_id',
        'scheduled_date',
        'start_time',
        'end_time',
        'session_type',
        'status',
        'title',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function cohort() : BelongsTo
    {
        return $this->belongsTo(Cohort::class);
    }

    public function weeklySchedule() : BelongsTo
    {
        return $this->belongsTo(CohortWeeklySchedule::class, 'cohort_weekly_schedule_id');
    }

    public function instructor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function module() : BelongsTo
    {
        return $this->belongsTo(ProgramModule::class, 'module_id');
    }

    public function lesson() : BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function attendances() : HasMany
    {
        return $this->hasMany(Attendance::class, 'schedule_id');
    }
}
